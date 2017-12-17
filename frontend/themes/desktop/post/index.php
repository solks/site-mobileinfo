<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

$t = "Настройка {$categoryName->cat_title}, Android";
if(!empty($tagName)) {
	$this->title = $tagName.' - '.$t;
	echo '<h1 class="page-title">'.$tagName.'</h1>';
} else {
	$this->title = $t; 
	echo '<h1 class="page-title">'.$categoryName->cat_title.'</h1>';
}

$i = 1;
?>
<?php foreach ($posts as $data) { ?>
<div class="item">
	<div class="item-title"><h2><?= Html::a(Html::encode($data->title), $data->url); ?></h2></div>
	<div class="title-decoration"><div class="dleft"></div><div class="dright"></div></div>
	<div class="item-content">
	<?php 
		$c_images = explode(';', $data->images);
		
		if (isset($c_images[0]) and $c_images[0] != '') { 
			$images = explode(',', $c_images[0]);
	?>
		<table class="content-container"><tr>
			<td>
				<div class="content-image">
					<?= $images[0]; ?>
				</div>
				<?php if (!empty($data->video)) { ?>
					<span class="label-video"><strong>Видео</strong></span>
					<a href="<?= $data->url ?>#video">
						<img src="http://img.youtube.com/vi/<?= $data->video ?>/default.jpg" alt="" class="thumb-video">
					</a>
				<?php } ?>
			</td>
			<td>
				<?=	$data->cont1; ?>
				<p class="readmore"><?= Html::a('Подробнее', $data->url, ['class' => 'btn btn-default btn-sm']); ?></p>
				<div class="item-nav">
					<b>Теги:</b>
					<?php 
						foreach($data->ActiveTags as $key => $val)
							echo Html::a($key, $val).', ';
					?>
					<br/>
					<?= Html::a("Комментарии ({$data->commentCount})", $data->url.'#comments'); ?> |
					Обновлено: <?= date('F j, Y',$data->update_time); ?>
				</div>
			</td>
		</tr></table>
	<?php } else echo $data->cont1; ?>
	</div>
</div>
<?php if ($i == 1 or $i == count($posts)) { ?>
<div class="a2">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-5001158605331260"
     data-ad-slot="6125077423"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<?php } ?>
<?php $i++; } ?>
<div class="pagination-container">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
