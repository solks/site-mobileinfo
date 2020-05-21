<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Блог';

foreach ($articles as $data) { 
	$img = json_decode($data['preview_img'], true);
?>
<div class="item">
	<div class="item-title">
		<?= Html::a($data->title, $data->url); ?>
	</div>
	<div class="row section">
		<div class="col-12 col-sm-auto section-image">
			<?= Html::img(
					'/images/blog/thumb/'.$img['src'].'.jpg',
					[
						'class' => 'blog-slider-img lazyload',
						'data-src' => '/images/blog/'.$img['src'].'.jpg',
						'width' => $img['width'],
						'height' => $img['height'],
					]
				); 
			?>
		</div>
		<div class="col-12 col-sm">
			<div class="blog-intro">
				<?=	$data->intro; ?>
			</div>
			<div class="readmore">
				<?= Html::a('Далее', $data->url, ['class' => 'btn btn-default']); ?>
			</div>
			<div class="item-nav">
				Опубликовано: <?= date('F j, Y',$data->create_time); ?>
			</div>
		</div>
	</div>
	
</div>
<?php } ?>
<div class="pagination-container">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
