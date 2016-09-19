<?php
namespace frontend\components;

use Yii;
use yii\captcha\Captcha;
use yii\helpers\Html;

class HtmlCaptcha extends Captcha
{
   
    public function run()
    {
        //$this->registerClientScript();
        if ($this->hasModel()) {
            $input = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $input = Html::textInput($this->name, $this->value, $this->options);
        }
        
        $captcha = Yii::$app->controller->createAction('captcha');
        $captcha->run();
        
        echo $input;
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $options = $this->getClientOptions();
        $options = empty($options) ? '' : Json::encode($options);
        $id = $this->imageOptions['id'];
        $view = $this->getView();
        CaptchaAsset::register($view);
        $view->registerJs("jQuery('#$id').yiiCaptcha($options);");
    }
}
