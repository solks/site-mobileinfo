<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\widgets\PostSlider;
use frontend\widgets\RenderHeader;

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
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap&subset=cyrillic" rel="stylesheet">
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
	<div id="head-nav" class="header" role="navigation">
		<div class="row">
			<div class="col-auto logo">
				<a href="/"><span class="logo-img"></span></a>
			</div>
			<div id="menu-list" class="col-md d-none d-md-block categories-menu">
				<ul class="categories">
					<li><?= Html::a('Samsung', Url::to(['post/index', 'category' => 'samsung']), ['class' => 'm-item']); ?></li>
					<li><?= Html::a('Huawei/Honor', Url::to(['post/index', 'category' => 'huawei-honor']), ['class' => 'm-item']); ?></li>
					<li><?= Html::a('Meizu', Url::to(['post/index', 'category' => 'meizu']), ['class' => 'm-item']); ?></li>
					<li><?= Html::a('Xiaomi', Url::to(['post/index', 'category' => 'xiaomi']), ['class' => 'm-item']); ?></li>
					<li><?= Html::a('Nokia/Microsoft', Url::to(['post/index', 'category' => 'nokia-microsoft']), ['class' => 'm-item']); ?></li>
					<li><?= Html::a('Lenovo', Url::to(['post/index', 'category' => 'lenovo']), ['class' => 'm-item']); ?></li>
				</ul>
			</div>
			<div class="col d-block d-md-none">
				<a class="menu-btn" onclick="openMenu()"><span class="menu-icon"></span></a>
			</div>
			<div id="site-search" class="col-sm-4 col-md-3 d-none d-sm-block search-inline">
				<form action="/site/search" id="cse-search-box" class="sform" role="search">
					<input type="hidden" name="cx" value="partner-pub-5001158605331260:1362917028" />
					<input type="hidden" name="cof" value="FORID:10" />
					<input type="hidden" name="ie" value="UTF-8" />
					<input type="text" name="q" class="sform-input" placeholder="Search"/>
					<button class="sform-btn" type="submit" name="sa" value="Search"><span class="sform-icon"></span></button>
				</form>
			</div>
			<div class="col-auto d-block d-sm-none">
				<a class="search-btn" onclick="openSchForm()"><span class="search-icon"></span></a>
			</div>
			<div class="col-auto d-block d-sm-none">
				<a class="h-btn" href="http://www.youtube.com/channel/UC1xwv4mXDfhy142wbzuXC9Q/videos"><span class="h-youtube-icon"></span></a>
				<a class="h-btn" href="http://123htc.ru"><span class="h-htc-icon"></span></a>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-12 col-md-10 offset-md-1">
				<div class="row no-gutters">
					<div class="col-12 col-sm breadcrumbs-wrapper">
						<nobr>
							<?= Breadcrumbs::widget([
								'itemTemplate' => "<li>{link}</li>\n",
								'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
							]); ?>
						</nobr>
					</div>
					<div class="col-sm-auto d-none d-sm-block">
							<a class="b-btn" href="http://www.youtube.com/channel/UC1xwv4mXDfhy142wbzuXC9Q/videos"><span class="b-youtube-icon"></span></a>
							<a class="b-btn" href="http://123htc.ru"><span class="b-htc-icon"></a>
					</div>
				</div>
			</div>
		</div>
		<?= RenderHeader::widget(); ?>
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 a1">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- infosmartphone_headline -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5001158605331260"
     data-ad-slot="1238632070"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 content">
				<?= $content ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 posts-slider">
				<?= PostSlider::widget(['count' => 12]); ?>
			</div>
		</div>
		<div class="row footer-wrapper">
			<footer class="col-12 footer">
				<p>&copy; infoSmartphone.ru <?= date('Y') ?></p>
			<footer>
		</div>
	</div>
	<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
