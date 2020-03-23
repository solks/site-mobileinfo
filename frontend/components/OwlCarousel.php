<?php

namespace frontend\components;

use Yii;
use yii\base\Widget;
use yii\web\JsExpression;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dominus77\owlcarousel2\Carousel;
use frontend\components\OwlAnimateCssAsset;
use frontend\components\OwlCarouselAsset;

/**
 * Class Carousel
 * @package dominus77\owlcarousel2 - modified
 */
class OwlCarousel extends Carousel
{
    private $_id;

    public function init()
    {
        parent::init();

        $this->_id = $this->getId();
    }

    public function run()
    {
        if (!empty($this->items)) {
            $this->registerAssets();
            echo Html::beginTag($this->tag, $this->containerOptions) . PHP_EOL;
            echo $this->items . PHP_EOL;
            echo Html::endTag($this->tag) . PHP_EOL;
        }
    }

    public function registerAssets()
    {
        $options = $this->getOptions();
        $view = $this->getView();
        OwlCarouselAsset::register($view);

        if (isset($this->clientOptions['animateOut']) && (!empty($this->clientOptions['animateOut'])) ||
            (isset($this->clientOptions['animateIn']) && (!empty($this->clientOptions['animateIn'])))
        ) {
            OwlAnimateCssAsset::register($view);
        }

		// Temporary move to bundled.js
		// $script = new JsExpression("$('#{$this->_id}').owlCarousel({$options});");
		// $view->registerJs($script);

		if (!empty($this->clientScript))
			$view->registerJs($this->clientScript);
    }
}
