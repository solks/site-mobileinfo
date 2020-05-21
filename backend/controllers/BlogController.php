<?php

namespace backend\controllers;

use Yii;
use backend\models\Blog;
use backend\models\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use vova07\imperavi\actions\GetImagesAction;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class BlogController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'imageget', 'imageupload'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'imageget' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => '/images/blog/',
            	'path' => '@frontend/web/images/blog',
            ],
            'imageupload' => [
            	'class' => 'backend\components\ImageUploadAction2',
            	'url' => '/images/blog/origin/',
            	'path' => '@frontend/web/images/blog/origin/',
            	'urlRes' => Yii::$app->params['baseUrl'].'/images/blog/',
            	'pathRes' => '@frontend/web/images/blog/',
            	'unique' => false,
            	'replace' => true,
        	],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$model = new Blog();

		if ($model->load(Yii::$app->request->post())) {
			$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
			
			if ($model->save())
				return $this->redirect(['index']);
			else
        			return $this->render('error');
		}
		
		return $this->render('create', [
				'model' => $model,
		]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        	
			if ($model->save())
				return $this->redirect(['index']);
			else
        			return $this->render('error');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
