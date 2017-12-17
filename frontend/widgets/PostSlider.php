<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\Post;
use frontend\widgets\SlickMd;
use yii\web\JsExpression;

class PostSlider extends Widget
{
    public $count = 9;
    
    public $layout = 'desktop';
    
    public $items = [];

    public function run()
    {
        
        if (empty($this->items)) {
			$posts = Post::find()
				->joinWith('stat')
				->where(['status' => 2,])
				->orderBy('hits DESC')
				->limit($this->count)
				->all();
			
        	foreach ($posts as $post) {
        		$item = Html::a('<h4>'.$post->title.'</h4>', $post->url);
        		/*if ($post->images)
					$item .= Html::img('/images/content/thumbs/'.$post->images, ['class' => 'pull-left posts-slider-img']);
				*/
				$item .= Html::tag('p', date("M j, Y", $post->create_time), ['class' => 'posts-slider-date']);
				
				foreach (explode(', ', $post->tags) as $t) {	
					$item .= Html::tag('p', $t, ['class' => 'label label-default']).' ';
				}
				
				$items[] = $item;
        	}
        }
        
        if ($this->layout == 'desktop') {
        	$slidesToShow = 4;
        	$slidesToScroll = 4;
        } else {
        	$slidesToShow = 2;
        	$slidesToScroll = 2;
        }
        
		return SlickMd::widget([
			'itemContainer' => 'div',
			'containerOptions' => ['class' => 'posts-slider-content'],
			'items' => $items,
			// settings for js plugin, see http://kenwheeler.github.io/slick/#settings
			'clientOptions' => [
				'autoplay' => false,
				'dots'	 => false,
				'infinite' => true,
				'slidesToShow' => $slidesToShow,
				'slidesToScroll' => $slidesToScroll,
				'prevArrow' => '<button type="button" class="slick-prev slider-prev"></button>',
				'nextArrow' => '<button type="button" class="slick-next slider-next"></button>',
				// note, that for params passing function you should use JsExpression object
				'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
			],
		]);
    }
}
