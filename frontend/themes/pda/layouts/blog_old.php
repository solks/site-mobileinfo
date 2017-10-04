<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\widgets\BlogSlider;
use frontend\widgets\NavPosts;
use frontend\widgets\NavTags;

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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-20779895-8', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
	<?php $this->beginBody() ?>
	<div class="container">
		<div class="row header">
			<div class="col-sm-5"><img class="img-rounded logo" src="/images/logo.png"></div>
			<div class="col-sm-7">
				<form class="navbar-form navbar-right " role="search">
					<input type="text" class="form-control" placeholder="Поиск">
				</form>
			</div>
		</div>
		<div class="row categories-menu">
			<div class="col-sm-12 categories">
				<strong><?= Html::a('Samsung', Url::to(['post/index', 'category' => 'samsung'])); ?></strong>
				<strong><?= Html::a('Nokia/Microsoft', Url::to(['post/index', 'category' => 'nokia-microsoft'])); ?></strong>
				<strong><?= Html::a('Lenovo', Url::to(['post/index', 'category' => 'lenovo'])); ?></strong>
				<?= Html::tag('span', 'Sony', ['class' => 'inactive-category']); ?>
				<?= Html::tag('span', 'LG', ['class' => 'inactive-category']); ?>
				<?= Html::tag('span', 'Fly', ['class' => 'inactive-category']); ?>
			</div>
		</div>
		<div class="row blog-slider">
			<div class="col-sm-2 blog-slider-cover">
				<div class="cover-title">
					<span>Популярное</span>
				</div>
			</div>
			<div class="col-sm-10 blog-slider-content">
				<?= BlogSlider::widget(['count' => 6]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 content-sidebar"></div>
			<div class="col-sm-10">
				<?= $content ?>
			</div>
		</div>
		<footer class="row footer">
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