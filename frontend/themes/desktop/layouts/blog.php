<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\widgets\BlogSlider;
use frontend\widgets\PostSlider;
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
	<div class="container-fluid">
		<div class="row header">
			<div class="col-sm-12">
				<a href="/"><img class="logo" src="/images/logo.png"></a>
				<div class="header-nav pull-right"><a href="http://123htc.ru"><img class="header-icon" src="/images/htc.png"></a></div>
				<div class="header-nav pull-right"><a href="http://www.youtube.com/channel/UC1xwv4mXDfhy142wbzuXC9Q/videos"><img class="header-icon" src="/images/youtube.png"></a></div>
			</div>
		</div>
		<div class="row categories-menu" id="toogle-nav">
			<div class="col-xs-12 col-sm-12 search hide" id="search-box">
				<div cass="row">
					<div class="col-xs-11 col-sm-11">
						<form action="/site/search" id="cse-search-box" class="form-inline" role="search">
							<input type="hidden" name="category" value="" />
							<input type="hidden" name="cx" value="partner-pub-5001158605331260:1362917028" />
							<input type="hidden" name="cof" value="FORID:10" />
							<input type="hidden" name="ie" value="UTF-8" />
							<input type="text" class="form-control" name="q" size="25"/>
						</form>
					</div>
					<div class="col-xs-1 col-sm-1 btn-holder">
						<button type="button" onclick="toogleBoxes('search-box','categories-box')" class="btn-menu pull-right">
							<span class="glyphicon glyphicon-align-justify pull-right"></span>
						</button>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 categories" id="categories-box">
				<strong><?= Html::a('Samsung', Url::to(['post/index', 'category' => 'samsung'])); ?></strong>
				<strong><?= Html::a('Nokia/Microsoft', Url::to(['post/index', 'category' => 'nokia-microsoft'])); ?></strong>
				<strong><?= Html::a('Lenovo', Url::to(['post/index', 'category' => 'lenovo'])); ?></strong>
				<strong><?= Html::a('Meizu', Url::to(['post/index', 'category' => 'meizu'])); ?></strong>
				<button type="button" onclick="toogleBoxes('categories-box','search-box')" class="btn-menu pull-right">
					<span class="glyphicon glyphicon-search navbar-right"></span>
				</button>
			</div>
		</div>
		<div class="row blog-slider">
			<div class="col-sm-12 blog-slider-content">
				<?= BlogSlider::widget(['count' => 6]); ?>
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
<script type="text/javascript" src="http://www.google.ru/coop/cse/brand?form=cse-search-box&amp;lang=ru"></script>
<script>
function bhide(elmshow, elmhide) {
    document.getElementById(elmhide).style.display = 'none';
    document.getElementById(elmshow).style.display = 'block';
};
</script>
<script type="text/javascript">
	function toogleBoxes(a,b) {
		var openBox=document.getElementById(a);
		var closedBox=document.getElementById(b);
		if(openBox.className.indexOf("hide")==-1){
			openBox.className += " hide";
			if(closedBox.className.indexOf("hide")){
				closedBox.className=closedBox.className.replace(/ hide/,"");
			}
		}
		return;
	}
</script>
</body>
</html>
<?php $this->endPage() ?>
