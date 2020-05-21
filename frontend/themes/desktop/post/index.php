<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

$t = 'Настройка '.$categoryName.', Android';
if(!empty($tagName)) {
	$this->title = $tagName.' - '.$t;
} else {
	$this->title = $t;
}

$i = 1;

foreach ($posts as $data) { ?>
<div class="item">
	<div class="item-title">
		<?= Html::a($data->title, $data->url); ?>
		<?php if (!empty($data->video)) { ?>
		<a href="<?= $data->url ?>#video" class="video-btn"><span class="video-icon"></span></a>
		<?php } ?>
	</div>
	<div class="row section">
		<div class="col-12 col-sm-auto section-image">
			<?php
				if (isset($data->postImages['1-0'])) {
					$fname = $data->postImages['1-0']['src'].'.jpg';
					echo Html::img(
						'/images/content/thumb/'.$fname,
						[
							'class' => 'lazyload',
							'data-src' => '/images/content/'.$fname,
							'alt' => $data->postImages['1-0']['alt'],
							'width' => $data->postImages['1-0']['width'],
							'height' => $data->postImages['1-0']['height'],
						]
					);
				}
			?>
		</div>
		<div class="col-12 col-sm">
			<?=	$data->cont1; ?>
			<div class="readmore"><?= Html::a('Подробнее', $data->url, ['class' => 'btn btn-default']); ?></div>
		</div>
	</div>
	<div class="row no-gutters">
		<div class="col-lg-auto d-none d-lg-block">
			<div class="item-nav-sp"> </div>
		</div>
		<div class="col-12 col-lg">
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
		</div>
	</div>
</div>
<?php if ($i == 1 or $i == count($posts)) { ?>
<!--<div class="a2">
</div>-->
<?php } ?>
<?php $i++; } ?>
<div class="pagination-container">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
