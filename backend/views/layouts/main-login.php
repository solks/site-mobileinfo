<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Перейти на сайт',
                'brandUrl' => 'http://infosmartphone.ru', //Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                    'target' => '_blank',
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
        	<div class="row">
        		<div class="col-sm-2 col-md-3"></div>
        		<div class="col-sm-8 col-md-6 main">
        			<?= $content ?>
        		</div>
        		<div class="col-sm-2 col-md-3"></div>
        	</div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; infosmartphone.ru <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
