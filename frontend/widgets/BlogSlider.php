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
				->asArray()
				->all();
			
        	foreach ($rows as $row) {
        		$blogUrl = Url::to(['blog/view', 'id' => $row['id'], 'title' => $row['alias']]);
        		
        		if ($this->layout == 'desktop') {
        			$items[] = Html::img($row['preview_img'], ['class' => 'blog-slider-img pull-left'])
						.'<h3>'.Html::a($row['title'], Url::to(['blog/view', 'id' => $row['id'], 'title' => $row['alias']])).'</h3>'
						.$row['intro'];
        		} else {
        			$items[] = Html::img($row['preview_img'], ['class' => 'blog-slider-img pull-left'])
						.'<h3>'.Html::a($row['title'], $blogUrl).'</h3>'
						.'<p>'.Html::a("Читать далее &raquo;", $blogUrl, ['class' => 'btn btn-default']).'</p>';
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
