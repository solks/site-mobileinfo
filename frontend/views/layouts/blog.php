<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\widgets\BlogSlider;
use frontend\widgets\PostNavSlider;
use frontend\widgets\Tags;

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
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>
	<div class="container">
		<div id="header" class="row">
			<div class="col-sm-5"><img id="logo" class="img-rounded" src="logo.png"></div>
			<div class="col-sm-7">
				<form class="navbar-form navbar-left" role="search">
					<input type="text" class="form-control" placeholder=" ">
					<button type="submit" class="btn btn-default">Search</button>
				</form>
				<img src="tips.png">
			</div>
		</div>
		<div id="cat-line" class="row">
			<div class="col-sm-12 categories">
				<?= Html::a('Samsung', Url::to(['post/index', 'category' => 'samsung'])); ?>
				<?= Html::a('Lenovo', Url::to(['post/index', 'category' => 'lenovo'])); ?>
				<?= Html::a('ASUS', Url::to(['post/index', 'category' => 'asus'])); ?>
			</div>
		</div>
		
		<div class="row">
			<div id="content-sidebar" class="col-sm-2"></div>
			<div class="col-sm-10">
				<?= $content ?>
			</div>
		</div>
		<footer class="row" id="footer">
			<p>&copy; My Company <?= date('Y') ?></p>
		</footer>
	
	</div>

	<?php $this->endBody() ?>
<script>
function bhide(elmshow, elmhide) {
    document.getElementById(elmhide).style.display = 'none';
    document.getElementById(elmshow).style.display = 'block';
};
</script>
</body>
</html>
<?php $this->endPage() ?>
