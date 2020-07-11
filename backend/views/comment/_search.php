<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CommentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row comment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php
        $id_input = $form->field($model, 'post_id');
        $id_input->template = "<div class=\"col-sm-2 comment-sch-id\">{label}</div><div class=\"col-sm-3\">{input}\n{hint}\n{error}</div>";
        echo $id_input;
    ?>

    <div class="col-sm-7">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
