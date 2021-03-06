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
$category = isset($_GET['category']) ? $_GET['category'] : 'samsung';
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
<!--<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-20779895-8', 'auto');
  ga('send', 'pageview');

</script>-->
</head>
<body>
	<?php $this->beginBody() ?>
	<div class="navbar-fixed-top">
		<div class="header" role="navigation">
			<div class="col-xs-2">
				<a href="/"><img class="logo" src="/images/logonew_.svg" alt="ISmart"></a>
			</div>
			<div class="col-xs-7 categories-menu">
				<ul class="categories">
					<li>
						<?= Html::a(
							'Samsung', 
							Url::to(['post/index', 'category' => 'samsung']), 
							['class' => $category == 'samsung' ? 'selected' : '']); 
						?>
					</li>
					<li>
						<?= Html::a(
							'Nokia/Microsoft', 
							Url::to(['post/index', 'category' => 'nokia-microsoft']),
							['class' => $category == 'nokia-microsoft' ? 'selected' : '']); 
						?>
					</li>
					<li>
						<?= Html::a(
							'Lenovo', 
							Url::to(['post/index', 'category' => 'lenovo']),
							['class' => $category == 'lenovo' ? 'selected' : '']); 
						?>
					</li>
					<li>
						<?= Html::a(
							'Meizu', 
							Url::to(['post/index', 'category' => 'meizu']),
							['class' => $category == 'meizu' ? 'selected' : '']); 
						?>
					</li>
					<li>
						<?= Html::a(
							'Xiaomi', 
							Url::to(['post/index', 'category' => 'xiaomi']),
							['class' => $category == 'xiaomi' ? 'selected' : '']); 
						?>
					</li>
				</ul>
			</div>
			<div class="col-xs-3 search">
				<div class="stylish-search-form">
					<form action="/site/search" id="cse-search-box" class="input-group" role="search">
						<input type="hidden" name="cx" value="partner-pub-5001158605331260:1362917028" />
						<input type="hidden" name="cof" value="FORID:10" />
						<input type="hidden" name="ie" value="UTF-8" />
						<input type="text" name="q" size="30" class="form-control" placeholder="Search"/>
						<span class="input-group-addon">
							<button type="submit" name="sa" value="Search">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</form>
				</div>
			</div>
		</div>
		<div class="nav-tags">
			<div class="col-xs-12 text-center">
				<?= NavTags::widget(); ?>
			</div>
		</div>
	</div>
	<div class="row m-top">
		<div class="col-xs-7 col-sm-8 col-sm-offset-1 breadcrumbs-wrapper">
			<?= Breadcrumbs::widget([
				'itemTemplate' => "<li>{link}</li>\n",
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]); ?>
		</div>
		<div class="col-xs-4 col-sm-2">
			<div class="pull-right">
				<a href="http://123htc.ru"><img class="ext-icon" src="/images/htc.png"></a>
			</div>
			<div class="pull-right">
				<a href="http://www.youtube.com/channel/UC1xwv4mXDfhy142wbzuXC9Q/videos"><img class="ext-icon" src="/images/youtube.png"></a>
			</div>
		</div>
	</div>
	<div class="row blog-slider-wrapper">
		<div class="hidden-xs col-sm-10 col-sm-offset-1 blog-slider">
			<?= BlogSlider::widget(['count' => 3]); ?>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 content">
				<?= $content ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="hidden-xs col-sm-12 posts-slider">
			<?= PostSlider::widget(['count' => 12]); ?>
		</div>
	</div>
	<div class="row footer-wrapper">
		<footer class="col-xs-12 footer">
			<p>&copy; infoSmartphone.ru <?= date('Y') ?></p>
		<footer>
	</div>

	<?php $this->endBody() ?>
<!--<script type="text/javascript" src="http://www.google.ru/coop/cse/brand?form=cse-search-box&amp;lang=ru"></script>-->
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
