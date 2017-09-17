<?php
use yii\helpers\Html;
?>

<div class="panel panel-default" id="c<?= $model->id; ?>">
	<div class="panel-heading">
		<?= Html::a(
				'#'.$model->post_id.'/'.$model->id, 
				['post/view', 'id' => $model->post->id, '#' => 'comments'], 
				['class'=>'btn btn-default active pull-right', 'title'=>'Ссылка на этот комментарий'] 
		); ?>
		<span class="c-author"><strong><?= $model->author; ?></strong></span>,
		<span class="text-muted"><?= date('j M, Y \a\t H:i', $model->create_time); ?> -><span> 
		<?= Html::a($model->post->title, Yii::$app->urlManagerFrontend->createUrl([
            				'post/view', 
            				'id' => $model->post->id, 
            				'category' => $model->post->category,
            				'title' => $model->post->alias,
            			]) ); ?>
		<br/>
		<div class="c-control">
			<?php if($model->status == 1): ?>
				<span class="pending">Ожидает подтверждения</span> |
				<?= Html::a('Approve', ['comment/approve', 'post_id' => $model->post_id, 'id' => $model->id] ); ?> |
			<?php endif; ?>
			<?= Html::a('Update', ['comment/update', 'post_id' => $model->post_id, 'id' => $model->id], ['data-method' => 'post']); ?> |
			<?= Html::a('Delete', ['comment/delete', 'post_id' => $model->post_id, 'id' => $model->id], ['data-method' => 'post']); ?>
		</div>
	</div>
	<div class="panel-body">
		<?php echo nl2br($model->content); ?>
	</div>
</div><!-- comment -->
