<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
	'id' => 'comment-form',
	'enableClientScript' => false,
	'enableAjaxValidation' => false,
	'enableClientValidation' => false,
]); ?>

<div class="cform">
	<?= $form->field($model, 'author')->textInput(['maxlength'=>128]); ?>
	<?= $form->field($model, 'content')->textarea(['rows'=>6]); ?>
	<?= $form->field($model, 'verifyCode')->widget('frontend\components\HtmlCaptcha')?>
	<div class="buttons">
		<?= Html::submitButton('Добавить', ['class' => 'btn-submit']) ?>
	</div>
</div><!-- form -->

<?php ActiveForm::end(); ?>
