<?php
/**
 * Asset manager for Yii2 Slick widget.
 * 
 * @author Evgeniy Chernishev <EvgeniyRRU@gmail.com>
 */

namespace frontend\widgets;

use evgeniyrru\yii2slick\SlickAsset;

class SlickAssetMd extends SlickAsset
{
    public $css = [];

    public $js = [
        'slick.min.js',
    ];
} 
