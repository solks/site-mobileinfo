<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = $post->title; 
?>

<h1 class="page-title"><?= $this->title ?></h1>

<div class="post">
	<div class="intro">
		<?= $post->intro ?>
	</div>
	<?php
		$c_images = explode(';', $post->images);
		
		$i=1; 
		while($i<=3 and $post->{'cont'.$i} != '') { 
	?>
	<div class="post-content">
		<?php 
			if (isset($c_images[$i-1]) and $c_images[$i-1] != '') {
				$images = explode(',', $c_images[$i-1]);
		?>
		<table class="content-container"><tr>
			<td>
				<div class="content-image">
					<?= Html::img(Yii::$app->params['baseUrl'].'/images/content/'.$images[0]); ?>
				</div>
			</td>
			<td>
				<?=	$post->{'cont'.$i++} ?>
			</td>
		</tr></table>
		<?php 
			} else echo $post->{'cont'.$i++};
		?>
	</div>
	<?php 
		} 
		if ($post->video != '') { 
	?>
		<div class="marker" id="video">Видео</div>
		<div class="post-content">
			<p style="text-align:center;">
				<iframe width="420" height="315" src="//www.youtube.com/embed/<?php echo $post->video; ?>" frameborder="0" allowfullscreen></iframe>
			</p>
		</div>
	<?php } ?>
	<div class="post-nav">
		<b>Теги:</b>
		<?php 
			foreach($post->ActiveTags as $key => $val)
				echo Html::a($key, $val).', ';
		?>
		<br/>
		<?php echo Html::a("Комментарии ({$post->commentCount})", $post->url.'#comments'); ?> |
		Обновлено: <?php echo date('F j, Y',$post->update_time); ?>
	</div>
</div>
<div id="comments">
	<?php if($post->commentCount>=1): ?>
		<div class="comments-marker">Комментарии</div>
			<?php foreach($post->comments as $comment): ?>
			<div class="comment-wrap">
				<div class="cid">
					<?= Html::a('#'.$comment['id'], $post->url.'#c'.$comment['id'], array('title'=>'Ссылка на этот комментарий')); ?>
				</div><div class="comment" id="c<?= $comment['id']; ?>">
					<div class="comment-details">
						<span class="comment-author"><?= $comment['author']; ?></span>
						<span class="comment-time">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?= date('F j, Y \a\t h:i',$comment['create_time']); ?></span>
					</div>
					<div class="comment-content">
						<?= nl2br($comment['content']); ?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
	<?php else :?>
		<div class="comments-marker">Добавить комментарий</div>
	<?php endif; ?>
	
	<?= $this->render('_commentForm', [
			'model'=>$newComment,
	]); ?>
</div><!-- comments -->
