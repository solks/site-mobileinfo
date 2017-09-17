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
			echo $post->{'cont'.$i};
		 
			if (isset($c_images[$i-1]) and $c_images[$i-1] != '') {
				$images = explode(',', $c_images[$i-1]);
				echo '<div class="content-image">'.$images[0].'</div>';
			}
		?>
	</div>
		<?php if ($i == 1) { ?>
			<div class="a1m">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- infosmartphone_main -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5001158605331260"
     data-ad-slot="9328303426"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
			</div>
		<?php } ?> 
	<?php $i++; } ?>
	
	<?php if ($post->video != '') { ?>
		<div class="marker" id="video">Видео</div>
		<div class="post-content">
			<p style="text-align:center;">
				<iframe width="300" height="225" src="//www.youtube.com/embed/<?php echo $post->video; ?>" frameborder="0" allowfullscreen></iframe>
			</p>
		</div>
	<?php 
		}
	?>
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
	<div class="comments-marker">Комментарии</div>
	
	<?= $this->render('_commentForm', [
			'model'=>$newComment,
	]); ?>
	
	<?php foreach($post->comments as $comment): ?>
		<div class="comment-wrap">
			<div class="cid">
				<?= Html::a('#'.$comment['id'], $post->url.'#c'.$comment['id'], array('title'=>'Ссылка на этот комментарий')); ?>
			</div><div class="comment" id="c<?= $comment['id']; ?>">
				<div class="comment-details">
					<span class="comment-author"><?= $comment['author']; ?></span>
					<span class="comment-time">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?= date('j M, Y \a\t H:i',$comment['create_time']); ?></span>
				</div>
				<div class="comment-content">
					<?= nl2br($comment['content']); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div><!-- comments -->
