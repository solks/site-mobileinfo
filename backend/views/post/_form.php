<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use backend\models\Tag;
use backend\models\Category;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['size'=>80, 'maxlength' => 128]) ?>

    <?= $form->field($model, 'alias')->textInput(['size'=>80, 'maxlength' => 128]) ?>

    <?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(Category::find()->asArray()->all(), 'cat_alias',  'cat_title')) ?>

    <?= $form->field($model, 'intro')->widget(Widget::className(), [
			'settings' => [
				'lang' => 'ru',
				'minHeight' => 200,
				'buttonSource' => true,
				'imageManagerJson' => Url::to(['/post/imageget']),
				'imageUpload' => Url::to(['/post/imageupload']),
				'plugins' => [
					'clips',
					'imagemanager',
 				]
			]
		]); 
	?>

    <?= $form->field($model, 'cont1')->widget(Widget::className(), [
			'settings' => [
				'lang' => 'ru',
				'minHeight' => 200,
				'buttonSource' => true,
				'imageManagerJson' => Url::to(['/post/imageget']),
				'imageUpload' => Url::to(['/post/imageupload']),
				'plugins' => [
					'clips',
					'imagemanager',
 				]
			]
		]); 
	?>

    <?= $form->field($model, 'cont2')->widget(Widget::className(), [
			'settings' => [
				'lang' => 'ru',
				'minHeight' => 200,
				'buttonSource' => true,
				'imageManagerJson' => Url::to(['/post/imageget']),
				'imageUpload' => Url::to(['/post/imageupload']),
				'plugins' => [
					'clips',
					'imagemanager',
 				]
			]
		]); 
	?>

    <?= $form->field($model, 'cont3')->widget(Widget::className(), [
			'settings' => [
				'lang' => 'ru',
				'minHeight' => 200,
				'buttonSource' => true,
				'imageManagerJson' => Url::to(['/post/imageget']),
				'imageUpload' => Url::to(['/post/imageupload']),
				'plugins' => [
					'clips',
					'imagemanager',
 				]
			]
		]); 
	?>

    <?= $form->field($model, 'video')->textInput(['size'=>30, 'maxlength' => 16]) ?>
    <p class="help-block">Вставте уникальный идентификатор, как на примере:<br> http://www.youtube.com/watch?v=<strong>3bmVQg_U3QY</strong></p>

    <?= $form->field($model, 'tags')->widget(AutoComplete::className(), [
    		'clientOptions' => [
    			'source' => ArrayHelper::getColumn(Tag::find()->asArray()->all(), 'name')
    		],
    		'options' => [
    			'class' => 'form-control',
    		],
    	]); 
    ?>
    <p class="help-block">Разделяйте теги коммами.</p>

    <?= $form->field($model, 'status')->dropDownList([ 2 => 'Опубликовано', 1 => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
