<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Tag;

class NavTags extends Widget
{
	public $category = '';

	public $tag = '';

    public function run()
    {
        $cache = Yii::$app->cache;

		$items = $cache->get('tags-'.$this->category);
		if ($items === false) {
			$items = Tag::find()->filterWhere(['category' => $this->category])->orderBy('name')->asArray()->all();

			$cache->set('tags-'.$this->category, $items, 3600);
		}

        $res = '';

        foreach ($items as $item) {
        	$res .= Html::a(
        		$item['name'],
        		Url::to(['post/index', 'category' => $this->category, 'tag' => $item['t_name']]),
        		['class' => $item['t_name'] == $this->tag ? 'tag active' : 'tag']
        	)
        	."\n";
        }
        
        return $res;
    }
}
