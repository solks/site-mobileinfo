<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
	'id'=>'comment-form',
	'enableClientScript' => false,
	'enableClientValidation' => false,
]); ?>

<div class="cform">
	<div class="form-row">
		<?= $form->field($model, 'author')->textInput(['maxlength'=>128]); ?>
	</div>
	<div class="form-row">
		<?= $form->field($model, 'content')->textarea(['rows'=>6]); ?>
	</div>
	<div class="form-row">
		<?= $form->field($model, 'verifyCode')->widget('frontend\components\HtmlCaptcha')?>
	</div>
	<div class="form-row buttons">
		<?= Html::submitButton('Добавить') ?>
	</div>
</div><!-- form -->

<?php ActiveForm::end(); ?>
