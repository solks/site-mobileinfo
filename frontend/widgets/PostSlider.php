<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\Post;
use frontend\components\OwlCarousel;

class PostSlider extends Widget
{
	public $category = '';

	public $tag = '';

    public $count = 8;

    public function run()
    {
        $query = Post::find()
			->joinWith('stat')
			->where(['status' => 2,])
			->orderBy('hits DESC')
			->limit($this->count);

		if ($this->category != '') $query->andFilterWhere(['category' => $this->category]);
		if ($this->tag != '') $query->andFilterWhere(['like', 't_tags', $this->tag]);

		$posts = $query->all();

        $items = '';

        foreach ($posts as $post) {
        	$item = Html::a(Html::tag('h4', $post->title), $post->url);
    		/*if ($post->images)
				$item .= Html::img('/images/content/thumbs/'.$post->images, ['class' => 'pull-left posts-slider-img']);
			*/
			$item .= Html::tag('p', date("M j, Y", $post->create_time), ['class' => 'posts-slider-date']);

			foreach (explode(', ', $post->tags) as $t) {
				$item .= Html::tag('p', $t, ['class' => 'label label-default']).' ';
			}
			$items .= Html::tag('div', $item, ['class' => 'post-card'])."\n";
        }

		return OwlCarousel::widget([
			'items' => $items,
			'id' => 'w-pslider',
			//'tag' => 'div', // container tag name, default div
			//'containerOptions' => [/* ... */], // container html options
			'clientOptions' => [
				'loop' => false,
				'margin' => 10,
				'nav' => false,
				'responsive' => [
					0 => [
						'items' => 1,
					],
					576 => [
						'items' => 2,
					],
					768 => [
						'items' => 3,
					],
					992 => [
						'items' => 4,
					],
				],
			],
		]);
    }
}
