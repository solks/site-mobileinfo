<?php

namespace frontend\controllers;

use Yii;
use app\models\Post;
use app\models\Category;
use app\models\PostImage;
use app\models\Tag;
use app\models\Comment;
use app\models\Stat;
use yii\data\Pagination;
use yii\base\Theme;
use yii\helpers\Url;

class PostController extends \yii\web\Controller
{
	public $contentTitle = '';

    public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
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
		$cache = Yii::$app->cache;

		$query = Post::find()
			->where(['status' => 2])
        	->andFilterWhere(['like', 'category', $category])
        	->andFilterWhere(['like', 't_tags', $tag]);

		$pagination = new Pagination([
			'defaultPageSize' => 5,
			'totalCount' => $query->count(),
			'forcePageParam' => false,
		]);

		$posts = $query->orderBy('create_time DESC')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();

		$categories = $cache->get('categories');
		if ($categories === false) {
			$categories = Category::find()
				->select(['cat_alias', 'cat_title'])
				->where(['status' => 1])
				->orderBy('dsp_order ASC')
				->asArray()
				->all();

			$cache->set('categories', $categories, 3600);
		}

		$activeCategory = $cache->get($category);
		if ($activeCategory === false) {
			$activeCategory = Category::find()
				->select(['cat_alias', 'cat_title'])
				->filterWhere(['like', 'cat_alias', $category])
				->asArray()
				->one();

			$cache->set($category, $activeCategory, 3600);
		}

		$activeTag = ['name' => '', 't_name' => ''];
		if(!empty($tag)) {
			$activeTag = Tag::find()
				->select(['name', 't_name'])
				->filterWhere(['like', 'category', $category])
				->andfilterWhere(['like', 't_name', $tag])
				->asArray()
				->one();
		}

		$this->view->params['categories'] = $categories;

		$this->view->params['activeCategory'] = $activeCategory['cat_alias'];

		$this->view->params['tag'] = $activeTag['t_name'];

		if(!empty($tag)) {
			$url = Url::to(['post/index', 'category'=>$activeCategory['cat_alias'], 'tag'=>$activeTag['t_name']]);
			if(!empty(Yii::$app->request->queryString))
				$url .= '?'.Yii::$app->request->queryString;

			$this->view->params['breadcrumbs'] = [
				['label' => $activeCategory['cat_title'], 'url' => ['post/index', 'category' => $activeCategory['cat_alias']]],
				$activeTag['name'],
			];
			$this->contentTitle = $activeTag['name'].' - '.$activeCategory['cat_title'];
		} else {
			$url = Url::to(['post/index', 'category'=>$activeCategory['cat_alias']]);
			if(!empty(Yii::$app->request->queryString))
				$url .= '?'.Yii::$app->request->queryString;

			$this->view->params['breadcrumbs'] = [
				$activeCategory['cat_title'],
			];
			$this->contentTitle = $activeCategory['cat_title'];
		}

		if (Yii::$app->request->url != $url)
			$this->redirect($url, 301);

		return $this->render('index', [
			'categoryName' => $activeCategory['cat_title'],
			'tagName' => $activeTag['name'],
			'posts' => $posts,
			'pagination' => $pagination,
		]);
    }

    public function actionView($id = null)
    {
		$cache = Yii::$app->cache;

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
		if ($post === null)
        	throw new HttpException(404, 'The requested page could not be found.');
        elseif (Yii::$app->request->url != $post->url)
			$this->redirect($post->url, 301);

		Stat::increment($id);

		$categories = $cache->get('categories');
		if ($categories === false) {
			$categories = Category::find()
				->select(['cat_alias', 'cat_title'])
				->where(['status' => 1])
				->orderBy('dsp_order ASC')
				->asArray()
				->all();

			$cache->set('categories', $categories, 3600);
		}

		$activeCategory = $cache->get($post->category);
		if ($activeCategory === false) {
			$activeCategory = Category::find()
				->select(['cat_alias', 'cat_title'])
				->filterWhere(['like', 'cat_alias', $post->category])
				->asArray()
				->one();

			$cache->set($post->category, $activeCategory, 3600);
		}

		$this->view->params['categories'] = $categories;

		$this->view->params['activeCategory'] = $activeCategory['cat_alias'];

		$this->view->params['tag'] = '';

		$this->view->params['breadcrumbs'] = [
			['label' => $activeCategory['cat_title'], 'url' => ['post/index', 'category' => $post->category]],
			$post->title,
		];

		$this->contentTitle = $post->title;

        return $this->render('view', [
        	'post' => $post,
        	'newComment' => $newComment,
        ]);
    }
}
