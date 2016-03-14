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
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        
        $tags = Tag::find()->filterWhere(['category' => $category])->orderBy('name')->asArray()->all();
        
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
