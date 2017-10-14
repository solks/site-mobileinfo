<?php

namespace frontend\controllers;

use Yii;
use app\models\Post;
use app\models\Category;
use app\models\Tag;
use app\models\Comment;
use app\models\Stat;
use yii\data\Pagination;
use yii\base\Theme;

class PostController extends \yii\web\Controller
{
    public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		if (Yii::$app->devicedetect->isMobile()) {
			Yii::$app->view->theme = new Theme([
				'basePath' => '@app/themes/pda',
				'baseUrl' => '@web/themes/pda',
				'pathMap' => [
        			'@app/views' => '@app/themes/pda',
        		],
			]);
		}
		
		return true; // or false to not run the action
	}
	
	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'frontend\components\HtmlCaptchaAction',
				'minLength' => 5,
				'maxLength' => 5,
				'testLimit' => 1,
			],
		];
	}
    
    public function actionIndex($category = null, $tag = null)
    {
        $query = Post::find()->where(['status' => 2,])
        	->andFilterWhere(['like', 'category', $category])
        	->andFilterWhere(['like', 't_tags', $tag]);
		
		$pagination = new Pagination([
			'defaultPageSize' => 5,
			'totalCount' => $query->count(),
		]);
		
		$posts = $query->orderBy('create_time DESC')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
		$categoryName = Category::find()->filterWhere(['like', 'cat_alias', $category])->one();
		
		$tagName = '';
		if(!empty($tag)) {
			$tagName = Tag::find()
				->select('name')
				->filterWhere(['t_name' => $tag, 'category' => $category])
				->scalar();
		}
		
			
		return $this->render('index', [
			'categoryName' => $categoryName,
			'tagName' => $tagName,
			'posts' => $posts,
			'pagination' => $pagination,
		]);
    }

    public function actionView($id = null)
    {
        $newComment = new Comment;
        if(isset($_POST['Comment']))
		{
			$newComment->attributes = $_POST['Comment'];
			$newComment->post_id = $id;
			$newComment->create_time=time();
			if($newComment->save())
				$this->refresh();
		}
        
        $post = Post::findOne($id);
        Stat::increment($id);
        
        return $this->render('view', [
        	'post' => $post,
        	'newComment' => $newComment,
        ]);
    }
}
