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
            'id',
            //'title',
            [
            	'attribute' => 'title',
            	'format' => 'html',
            	'value' => function($model){ return Html::a($model->title, Url::to(['frontend/post/view', 'id' => $model->id])); },
            ],
            //'alias',
            [
            	'attribute' => 'category',
            	'format' => 'text',
            	'filter' => ArrayHelper::map(Category::find()->asArray()->all(), 'cat_alias',  'cat_title')
            ],
            //'category',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
