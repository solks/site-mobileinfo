<?php

namespace frontend\controllers;

use app\models\Post;
use app\models\Tag;
use app\models\Comment;
use yii\data\Pagination;

class PostController extends \yii\web\Controller
{
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
		
		$tagName = '';
		if(!empty($tag)) {
			$tagName = Tag::find()
				->select('name')
				->where(['t_name' => $tag, 'category' => $category])
				->scalar();
		}
		if(!empty($category))
			$categoryName = ucfirst($category);
		else
			$categoryName = 'Samsung, ASUS, Lenovo';
			
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
        
        return $this->render('view', [
        	'post' => $post,
        	'newComment' => $newComment,
        ]);
    }
}
