<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Blog;
use frontend\components\OwlCarousel;

class BlogSlider extends Widget
{
    public $count = 3;

    public function run()
    {
		$rows = Blog::find()->where(['status' => 2,])
			->limit($this->count)
			->orderBy('create_time DESC')
			->asArray()
			->all();

    	$items = '';
    	$blogUrl = Url::to('/blog');

    	foreach ($rows as $row) {
    		$articleUrl = Url::to(['blog/view', 'id' => $row['id'], 'title' => $row['alias']]);
			$img = json_decode($row['preview_img'], true);

			$item = Html::img(
					'/images/blog/thumb/'.$img['src'].'.jpg',
					[
						'class' => 'blog-slider-img lazyload',
						'data-src' => '/images/blog/'.$img['src'].'.jpg',
						'width' => $img['width'],
						'height' => $img['height'],
					]
				)
				.'<div class="blog-slider-intro">'
				.'<h3 class="blog-slider-title">'.Html::a($row['title'], $articleUrl).'</h3>'
				.$row['intro']
				.'</div>'
				.'<p class="readmore">'.Html::a("Блог &raquo;", $blogUrl, ['class' => 'btn btn-default']).'</p>';

			$items .= Html::tag('div', $item, ['class' => 'blog-card'])."\n";
    	}

		return OwlCarousel::widget([
			'items' => $items,
			'id' => 'w-bslider',
			'tag' => 'div',
			//'containerOptions' => ['class' => 'blog-slider-content'],
			'clientOptions' => [
				'loop' => false,
				'margin' => 0,
				'nav' => false,
				'items' => 1,
			],
		]);
    }
}
