<?php

namespace frontend\controllers;

use Yii;
use app\models\Blog;
use yii\data\Pagination;
use yii\base\Theme;

class BlogController extends \yii\web\Controller
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
