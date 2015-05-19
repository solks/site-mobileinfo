<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Blog;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;

class BlogSlider extends Widget
{
    public $count = 3;
    
    public $items = [];

    public function run()
    {
        
        if (empty($this->items)) {
			$rows = Blog::find()->where(['status' => 2,])
				->limit($this->count)
				->asArray()
				->all();
			
        	foreach ($rows as $row) {
        		$items[] = Html::img($row['preview_img'], ['class' => 'blog-slider-img pull-left'])
					.'<h3>'.Html::a($row['title'], Url::to(['blog/view', 'id' => $row['id'], 'title' => $row['alias']])).'</h3>'
					.'<p>'.$row['intro'].' ...</p>';
        	}
        }
        
		return Slick::widget([
			'itemContainer' => 'div',
			'items' => $items,
			// settings for js plugin, see http://kenwheeler.github.io/slick/#settings
			'clientOptions' => [
				'autoplay' => false,
				'dots'	 => false,
				'prevArrow' => '',
				'nextArrow' => '<button type="button" class="slick-next blog-slider-next"></button>',
				// note, that for params passing function you should use JsExpression object
				'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
			],
		]);
    }
}
