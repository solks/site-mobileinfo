<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [];
    public $depends = [];
    
    
    public function init() {
		if (Yii::$app->devicedetect->isMobile()) {
			$this->css = ['css/pda.css?v1.1'];
			$this->depends = [
				//'yii\web\YiiAsset',
				'yii\bootstrap\BootstrapAsset',
			];
			
			Yii::$app->assetManager->bundles = [
				'yii\web\YiiAsset' => false,
				'yii\web\JqueryAsset' => ['js' => []],
                'yii\bootstrap\BootstrapPluginAsset' => ['js' => []],
			];
		}
		else {
			$this->css = ['css/site.css?v1.4'];
			$this->depends = [
				//'yii\web\YiiAsset',
				'yii\bootstrap\BootstrapAsset',
			];
			
			Yii::$app->assetManager->bundles = [
                'yii\web\YiiAsset' => false,
				//'yii\web\JqueryAsset' => ['js' => []],
                'yii\bootstrap\BootstrapPluginAsset' => ['js' => []],
			];
    	}
    	
    	parent::init();
    }
}
