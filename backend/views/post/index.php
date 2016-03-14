<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджер материалов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новая статья', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
            	'attribute' => 'id',
            	'format' => 'text',
            	'options' => ['class' => 'id-col'],
            ],
            [
            	'attribute' => 'title',
            	'format' => 'html',
            	'value' => function($model){ return Html::a($model->title, Url::to(['post/update', 'id' => $model->id])); },
            ],
            //'alias',
            [
            	'attribute' => 'category',
            	'format' => 'text',
            	'filter' => ArrayHelper::map(Category::find()->asArray()->all(), 'cat_alias',  'cat_title')
            ],
            'tags:ntext',
            //'intro:ntext',
            // 'cont1:ntext',
            // 'cont2:ntext',
            // 'cont3:ntext',
            'video',
            // 'preview_img',
            // 't_tags:ntext',
            // 'status',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'author_id',

            [
            	'class' => 'yii\grid\ActionColumn',
            	'template' => '{view}&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;{delete}',
            	'options' => ['class' => 'actions-col-wide'],
            	'urlCreator' => function($action, $model, $key, $index) { 
            		if ($action == 'view') {
            			return Yii::$app->urlManagerFrontend->createUrl([
            				'post/view', 
            				'id' => $model->id, 
            				'category' => $model->category,
            				'title' => $model->alias,
            			]);
            		}
            		else 
            			return Url::to(['post/'.$action, 'id' => $model->id]);
            	},
            ],
        ],
    ]); ?>

</div>
