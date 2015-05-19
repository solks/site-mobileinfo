<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'intro') ?>

    <?php // echo $form->field($model, 'cont1') ?>

    <?php // echo $form->field($model, 'cont2') ?>

    <?php // echo $form->field($model, 'cont3') ?>

    <?php // echo $form->field($model, 'video') ?>

    <?php // echo $form->field($model, 'preview_img') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 't_tags') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
