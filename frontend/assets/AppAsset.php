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

		$this->css = ['css/site.css'];
		$this->js = ['js/bundled.js', 'js/lazysizes.min.js'];
		$this->jsOptions = ['async' => true];

		$this->depends = [
			'yii\web\JqueryAsset',
			//'davidhirtz\yii2\lazysizes\AssetBundle',
			//'yii\bootstrap4\BootstrapAsset',
			//'frontend\components\OwlCarouselAsset',
		];

		Yii::$app->assetManager->bundles = [
            'yii\web\YiiAsset' => false,
            'yii\web\JqueryAsset' => false,
            // 'frontend\components\OwlCarouselAsset' => false,
			//'yii\web\JqueryAsset' => ['js' => ['//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js']],
			//'yii\bootstrap4\BootstrapAsset' => ['css' => ['css/bootstrap-grid.min.css']],
            //'yii\bootstrap4\BootstrapPluginAsset' => ['js' => []],
		];
    }
}
