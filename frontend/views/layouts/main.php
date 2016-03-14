<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\widgets\BlogSlider;
use frontend\widgets\PostSlider;
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
</head>
<body>
	<?php $this->beginBody() ?>
	<div class="container-fluid">
		<div class="row header">
			<div class="col-sm-5"><img class="logo" src="/images/logo.png"></div>
			<div class="col-sm-7">
				<form class="navbar-form navbar-right " role="search">
					<input type="text" class="form-control" placeholder="Поиск">
				</form>
				<div class="header-nav navbar-right"><a href="http://123htc.ru"><img class="header-icon" src="/images/htc.png"></a></div>
				<div class="header-nav navbar-right"><a href="http://www.youtube.com/channel/UC1xwv4mXDfhy142wbzuXC9Q/videos"><img class="header-icon" src="/images/youtube.png"></a></div>
			</div>
		</div>
		<div class="row categories-menu">
			<div class="col-xs-12 col-sm-12 categories">
				<strong><?= Html::a('Samsung', Url::to(['post/index', 'category' => 'samsung'])); ?></strong>
				<strong><?= Html::a('Nokia/Microsoft', Url::to(['post/index', 'category' => 'nokia-microsoft'])); ?></strong>
				<strong><?= Html::a('Lenovo', Url::to(['post/index', 'category' => 'lenovo'])); ?></strong>
				<?= Html::tag('span', 'Sony', ['class' => 'inactive-category']); ?>
				<?= Html::tag('span', 'LG', ['class' => 'inactive-category']); ?>
				<?= Html::tag('span', 'Fly', ['class' => 'inactive-category']); ?>
			</div>
		</div>
		<div class="row nav-tags">
			<div class="col-xs-12 col-sm-12">
				<div class="text-center">
					<?= NavTags::widget(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="hidden-xs col-sm-12 blog-slider">
				<?= BlogSlider::widget(['count' => 2]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 content">
				<?= $content ?>
			</div>
		</div>
		<div class="row">
			<div class="hidden-xs col-sm-12 posts-slider">
				<?= PostSlider::widget(['count' => 12]); ?>
			</div>
		</div>
		<footer class="row footer">
			<p>&copy; infosmartphone.ru <?= date('Y') ?></p>
		</footer>
	
	</div>

	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
