<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

$t = "Настройка смартфонов, Android";
$this->title = $t;

$i = 1;
?> 
<?= '<h1 class="page-title">'.$this->title.'</h1>'; ?>

<?php foreach ($posts as $data) { ?>
<div class="item">
	<div class="item-title">
		<?= Html::a(Html::encode($data->title), $data->url); ?>
		<?php if (!empty($data->video)) { ?>
			<a href="<?= $data->url ?>#video" class="v-icon">
			</a>
		<?php } ?>
	</div>
	<div class="item-content">
	<?php 
		$c_images = explode(';', $data->images);
		
		if (isset($c_images[0]) and $c_images[0] != '') { 
			$images = explode(',', $c_images[0]);
	?>
		<table class="content-container"><tr>
			<td>
				<div class="content-image"><?= $images[0]; ?></div>
			</td>
			<td>
				<?=	$data->cont1; ?>
				<p class="readmore"><?= Html::a('Подробнее', $data->url, ['class' => 'btn btn-default']); ?></p>
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
<!--<div class="a2">
</div>-->
<?php } ?>
<?php $i++; } ?>
<div class="pagination-container">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
