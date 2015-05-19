<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Tag;

class NavTags extends Widget
{
    public function run()
    {
        $tags = Tag::find()->orderBy('name')->asArray()->all();
        
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        
        $res = '';
			
        foreach ($tags as $tag) {
        	$res .= Html::a(
        		$tag['name'], 
        		Url::to(['post/index', 'category' => $category, 'tag'=>$tag['t_name']]), 
        		['class' => 'label label-tag']
        	)
        	."\n";
        }
        
        return $res;
    }
}
