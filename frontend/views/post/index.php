<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

$t = "Настройка {$categoryName}, Android";
if(!empty($tagName)) {
	$this->title = $tagName.' - '.$t;
	echo '<h1 class="page-title">'.$tagName.'</h1>';
} else {
	$this->title = $t; 
	echo '<h1 class="page-title">'.$categoryName.'</h1>';
}
?>
<?php foreach ($posts as $data) { ?>
<div class="item">
	<div class="item-title"><h2><?= Html::a(Html::encode($data->title), $data->url); ?></h2></div>
	<div class="title-decoration"><div class="dleft"></div><div class="dright"></div></div>
	<div class="item-content">
	<?php 
		if (preg_match('/<img[^<]+?">/isu', $data->cont1, $images)) {
	?>
	<table class="content-container"><tr>
		<td>
			<?php foreach ($images as $image) echo '<div class="cont-image">'.$image.'</div>'; ?>
			<?php if (!empty($data->video)) { ?>
				<span class="label-video"><strong>Видео</strong></span>
				<a href="<?= $data->url ?>#video-block"><img src="http://img.youtube.com/vi/<?= $data->video ?>/default.jpg" alt="" class="thumb-video"></a>
			<?php } ?>
		</td>
		<td>
			<?=	preg_replace('/<img[^<]+?">/isu', '',  $data->cont1) ?>
			<p class="readmore"><?= Html::a('Подробнее', $data->url, array('class' => 'readmore')); ?></p>
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
	<?php } ?>
	</div>
	
</div>
<?php } ?>
<div class="pagination-container">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
