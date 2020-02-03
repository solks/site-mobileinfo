<?php

namespace frontend\components;

use yii\web\AssetBundle;

/**
 * Class OwlCarouselAsset
 * @package dominus77\owlcarousel2\assets - modified
 */
class OwlCarouselAsset extends AssetBundle
{
    public $sourcePath = '@bower/owlcarousel2/dist';

    public $css = [
        'assets/owl.carousel.min.css',
        'assets/owl.theme.default.css',
    ];
    
    public $js = [
        'owl.carousel.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
