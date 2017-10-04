<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use backend\models\Tag;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['size'=>80, 'maxlength' => 128]) ?>

    <?= $form->field($model, 'alias')->textInput(['size'=>80, 'maxlength' => 128]) ?>
    
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    
    <p>
    	<?php if ($model->preview_img) echo Html::img(Yii::$app->params['baseUrl'].$model->preview_img) ?>
	</p>
	
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

    <?= $form->field($model, 'content')->widget(Widget::className(), [
			'settings' => [
				'lang' => 'ru',
				'minHeight' => 200,
				'buttonSource' => true,
				'imageManagerJson' => Url::to(['/blog/imageget']),
				'imageUpload' => Url::to(['/blog/imageupload']),
				'plugins' => [
					'clips',
					'imagemanager',
 				]
			]
		]); 
	?>

    <?= $form->field($model, 'status')->dropDownList([ 2 => 'Опубликовано', 1 => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
