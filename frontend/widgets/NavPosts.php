<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\Post;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;

class NavPosts extends Widget
{
    public $count = 9;
    
    public $items = [];

    public function run()
    {
        
        if (empty($this->items)) {
			$posts = Post::find()->where(['status' => 2,])
				->orderBy('create_time DESC')
				->limit($this->count)
				->all();
			
        	foreach ($posts as $post) {
        		$item = Html::a('<h4>'.$post->title.'</h4>', $post->url);
        		if ($post->preview_img)
					$item .= Html::img('/images/content/thumbs/'.$post->preview_img, ['class' => 'pull-left nav-posts-img']);
				$item .= Html::tag('p', date("M j, Y", $post->create_time), ['class' => 'nav-posts-date']);
				
				foreach (explode(', ', $post->tags) as $t) {	
					$item .= Html::tag('p', $t, ['class' => 'label label-default']).' ';
				}
				
				$items[] = $item;
        	}
        }
        
		return Slick::widget([
			'itemContainer' => 'div',
			'items' => $items,
			// settings for js plugin, see http://kenwheeler.github.io/slick/#settings
			'clientOptions' => [
				'autoplay' => false,
				'dots'	 => false,
				'infinite' => true,
				'slidesToShow' => 3,
				'slidesToScroll' => 3,
				'prevArrow' => '',
				'nextArrow' => '<button type="button" class="slick-next nav-posts-next"></button>',
				// note, that for params passing function you should use JsExpression object
				'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
			],
		]);
    }
}
