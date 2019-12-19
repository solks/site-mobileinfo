<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Blog;
use frontend\widgets\SlickMd;
use yii\web\JsExpression;

class BlogSlider extends Widget
{
    public $count = 3;
    
    public $layout = 'desktop';
    
    public $items = [];

    public function run()
    {
        
        if (empty($this->items)) {
			$rows = Blog::find()->where(['status' => 2,])
				->limit($this->count)
				->orderBy('create_time DESC')
				->asArray()
				->all();
			
        	foreach ($rows as $row) {
        		$articleUrl = Url::to(['blog/view', 'id' => $row['id'], 'title' => $row['alias']]);
        		$blogUrl = Url::to('/blog');
        		
        		if ($this->layout == 'desktop') {
        			$items[] = Html::img($row['preview_img'], ['class' => 'blog-slider-img'])
						.'<div class="blog-slider-intro">'
						.'<h3 class="blog-slider-title">'.Html::a($row['title'], $articleUrl).'</h3>'
						.$row['intro']
						.'</div>'
						.'<p class="readmore">'.Html::a("Блог &raquo;", $blogUrl, ['class' => 'btn btn-default']).'</p>';
        		} else {
        			$items[] = Html::img($row['preview_img'], ['class' => 'blog-slider-img pull-left'])
						.'<h3>'.Html::a($row['title'], $articleUrl).'</h3>'
						.'<div class="readmore">'.Html::a("Блог &raquo;", $blogUrl, ['class' => 'btn btn-default']).'</div>';
				}
        	}
        }
        
		return SlickMd::widget([
			'itemContainer' => 'div',
			'containerOptions' => ['class' => 'blog-slider-content'],
			'items' => $items,
			// settings for js plugin, see http://kenwheeler.github.io/slick/#settings
			'clientOptions' => [
				'autoplay' => false,
				'dots'	 => false,
				'prevArrow' => '',
				'nextArrow' => '<button type="button" class="slick-next slider-next"></button>',
				// note, that for params passing function you should use JsExpression object
				'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
			],
		]);
    }
}
