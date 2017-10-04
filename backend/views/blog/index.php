<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджер материалов блога';
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
            'alias',
            //'intro:ntext',
            // 'content:ntext',
            // 'preview_img',
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
            				'blog/view', 
            				'id' => $model->id,
            				'title' => $model->alias,
            			]);
            		}
            		else 
            			return Url::to(['blog/'.$action, 'id' => $model->id]);
            	},
            ],
        ],
    ]); ?>

</div>
