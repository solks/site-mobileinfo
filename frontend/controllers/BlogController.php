<?php

namespace frontend\controllers;

use app\models\Blog;
use yii\data\Pagination;

class BlogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Blog::find()->where(['status' => 2,]);
		
		$pagination = new Pagination([
			'defaultPageSize' => 5,
			'totalCount' => $query->count(),
		]);
		
		$articles = $query->orderBy('create_time DESC')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
		$this->layout = 'blog';
		
        return $this->render('index', [
        	'articles' => $articles,
        	'pagination' => $pagination,
        ]);
    }

    public function actionView($id)
    {
        $article = Blog::findOne($id);
        
        $this->layout = 'blog';
        
        return $this->render('view', [
        	'data' => $article,
        ]);
    }

}
