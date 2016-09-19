<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1 class="page-title">Блог</h1>
<?php foreach ($articles as $data) { ?>
<div class="item">
	<div class="item-title"><h2><?= Html::a($data->title, $data->url); ?></h2></div>
	<div class="title-decoration"><div class="dleft"></div><div class="dright"></div></div>
	<div class="item-content">
		<p><?= Html::img($data->preview_img); ?></p>
		<?=	$data->intro; ?>
		<p class="readmore">
			<?= Html::a('Подробнее', $data->url, ['class' => 'btn btn-default btn-sm']); ?>
		</p>
		<div class="item-nav">
			Опубликовано: <?= date('F j, Y',$data->create_time); ?>
		</div>
	</div>
</div>
<?php } ?>
<div class="pagination-container">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
