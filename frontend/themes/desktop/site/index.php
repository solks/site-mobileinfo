<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

$i = 1;
?>

<?php foreach ($posts as $data) { ?>
<div class="item">
	<div class="item-title">
		<?= Html::a(Html::encode($data->title), $data->url); ?>
		<?php if (!empty($data->video)) { ?>
		<a href="<?= $data->url ?>#video" class="video-btn"><span class="video-icon"></span></a>
		<?php } ?>
	</div>
	<div class="row section">
		<?php 
			$c_images = explode(';', $data->images);
		
			if (isset($c_images[0]) and $c_images[0] != '') { 
				$images = explode(',', $c_images[0]);
		?>
		<div class="col-12 col-sm-auto section-image">
			<?= $images[0]; ?>
		</div>
		<?php } ?>
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
