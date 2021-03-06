<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<!--<h1 class="page-title">Блог</h1>-->
<?php foreach ($articles as $data) { ?>
<div class="item">
	<div class="item-title"><?= Html::a($data->title, $data->url); ?></div>
	<div class="item-content">
	<table class="content-container"><tr>
		<td>
			<?= Html::img($data->preview_img); ?>
		</td>
		<td>
			<div class="blog-intro">
				<?=	$data->intro; ?>
			</div>
			<p class="readmore">
				<?= Html::a('Подробнее', $data->url, ['class' => 'btn btn-default']); ?>
			</p>
			<div class="item-nav">
				Опубликовано: <?= date('F j, Y',$data->create_time); ?>
			</div>
		</td>
	</tr></table>
	</div>
	
</div>
<?php } ?>
<div class="pagination-container">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
