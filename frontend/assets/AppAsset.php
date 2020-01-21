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
    	parent::init();
    	
		$this->css = ['css/site.css?v2.0.1b'];
		$this->depends = [
			//'yii\web\YiiAsset',
			'yii\bootstrap4\BootstrapAsset',
			'davidhirtz\yii2\lazysizes\AssetBundle',
		];
		
		Yii::$app->assetManager->bundles = [
            'yii\web\YiiAsset' => false,
			'yii\web\JqueryAsset' => ['js' => ['//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js']],
			'yii\bootstrap4\BootstrapAsset' => ['css' => ['css/bootstrap-grid.min.css']],
            'yii\bootstrap4\BootstrapPluginAsset' => ['js' => []],
		];
    }
}
