<?php
use yii\helpers\StringHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
        	<?php  
        		/*$expected = crypt($model->password, $model->getUser()->password_hash);
        		$actual = $model->getUser()->password_hash;
        		$expected .= "\0";
        		$actual .= "\0";
        
        		echo $expected."<br>";
        		echo $actual."<br>";
        		$expectedLength = StringHelper::byteLength($expected);
        		$actualLength = StringHelper::byteLength($actual);
        		$diff = $expectedLength - $actualLength;
        		for ($i = 0; $i < $actualLength; $i++) {
            		$diff |= (ord($actual[$i]) ^ ord($expected[$i % $expectedLength]));
            		//echo $diff."<br>";
        		} */
        	
        		//if(!function_exists('password_hash')) echo 'No'; 
        		//print_r($model->getUser()); 
        		//echo 'Pass:'.$model->password.'<br>Hash:'.$model->getUser()->password_hash;
        	?>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
