<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;

class RenderHeader extends Widget
{
	public $title = '';
	public $wrapper = True;

	public function init()
	{
		parent::init();
		
		$this->title = Yii::$app->controller->contentTitle;
	}
	
	public function run()
	{
		if ($this->wrapper) {
			$w1 = '<div class="row content-title-wrapper"><div class="col-12 col-md-10 offset-md-1">';
			$w2 = "</div></div>\n";
		} else 
			$w1 = $w2 = '';
		
		if (Yii::$app->controller->id == 'post') {
			$res = '<span class="suph1">Советы по настройке</span>'."\n";
		} elseif (Yii::$app->controller->id == 'blog') {
			$res = '<span class="suph1">IT-индустрия, разработки</span>'."\n";
		} elseif (Yii::$app->controller->id == 'site' and Yii::$app->controller->action->id == 'search') {
			$res = '<span class="suph1">Powered by Google</span>'."\n";
		} else {
			$res = '<span class="suph1">Советы по настройке, новости IT-индустрии</span>'."\n";
		}
		
		$res .= '<h1 class="content-title">'.$this->title.'</h1>'."\n";
		
		return  $w1.$res.$w2;
	}
}
