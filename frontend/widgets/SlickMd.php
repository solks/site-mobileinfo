<?php
/**
 * This is a wrapper for Slick Carousel plugin
 * @see http://kenwheeler.github.io/slick/
 *
 *
 * @author Evgeniy Chernishev <EvgeniyRRU@gmail.com>
 */
 
namespace frontend\widgets;

use evgeniyrru\yii2slick\Slick;
use yii\helpers\Json;

class SlickMd extends Slick
{
    protected function registerClientScript()
    {
        $view = $this->getView();

        SlickAssetMd::register($view);

        $options = Json::encode($this->clientOptions);
        $id = $this->containerOptions['id'];

        $js[] = "jQuery('#$id').slick($options);";

        $view->registerJs(implode(PHP_EOL, $js));
    }

} 
