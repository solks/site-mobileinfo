<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = $post->title;
?>
<div class="post">
	<div class="intro">
		<?= $post->intro ?>
	</div>
	<?php
		$i=1;
		while($i<=3 and $post->{'cont'.$i} != '') {
	?>
	<div class="row section">
		<div class="col-12 col-sm-auto section-image">
			<?php
				//foreach (array_filter($post->postImages, function ($k) use ($i) { return (int) $k[0] == $i; }, ARRAY_FILTER_USE_KEY) as $image) {
				//	echo '<img src="/images/content/'.$image['src'].'.jpg" alt ="'.$image['alt'].'">';
				//}
				if (isset($post->postImages[$i.'-0'])) {
					$fname = $post->postImages[$i.'-0']['src'].'.jpg';
					echo Html::img(
						'/images/content/thumb/'.$fname,
						[
							'class' => 'lazyload',
							'data-src' => '/images/content/'.$fname,
							'alt' => $post->postImages[$i.'-0']['alt'],
							'width' => $post->postImages[$i.'-0']['width'],
							'height' => $post->postImages[$i.'-0']['height'],
						]
					);
				}
			?>
		</div>
		<div class="col-12 col-sm">
			<?=	$post->{'cont'.$i}; ?>
		</div>
	</div>
	<?php $i++; } ?>
	<div class="a2">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- infosmartphone_links -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5001158605331260"
     data-ad-slot="3050750852"
     data-ad-format="link"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
	</div>
	<?php if ($post->video != '') { ?>
	<div id="video" class="s-title">Видео</div>
	<div class="section video-frame">
		<iframe width="550" height="360" class="lazyload" data-src="//www.youtube.com/embed/<?php echo $post->video; ?>" frameborder="0" allowfullscreen></iframe>
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
<div class="post-comments">
	<div id="comments" class="s-title">Комментарии</div>
	<div class="section">
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
	</div>
</div>
