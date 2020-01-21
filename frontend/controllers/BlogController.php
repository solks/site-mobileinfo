<?php

namespace frontend\controllers;

use Yii;
use app\models\Blog;
use yii\data\Pagination;
use yii\base\Theme;

class BlogController extends \yii\web\Controller
{
    public $contentTitle = '';
    
    public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}
		
		return true; // or false to not run the action
	}
    
    public function actionIndex()
    {
        $query = Blog::find()->where(['status' => 2,]);
		
		$pagination = new Pagination([
			'defaultPageSize' => 5,
			'totalCount' => $query->count(),
			'forcePageParam' => false,
		]);
		
		$articles = $query->orderBy('create_time DESC')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
			
		$this->view->params['breadcrumbs'] = [
			'Блог',
		];
		
		$this->contentTitle = 'Блог';
		
		$this->layout = 'blog';
		
        return $this->render('index', [
        	'articles' => $articles,
        	'pagination' => $pagination,
        ]);
    }

    public function actionView($id)
    {
        $article = Blog::findOne($id);
        
        $this->view->params['breadcrumbs'] = [
			['label' => 'Блог', 'url' => ['/blog']],
			$article->title,
		];
		
		$this->contentTitle = $article->title;
        
        $this->layout = 'blog';
        
        return $this->render('view', [
        	'data' => $article,
        ]);
    }

}
