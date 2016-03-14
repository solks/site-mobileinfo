<?php

namespace backend\components;

use vova07\imperavi\actions\UploadAction;
use yii\imagine\Image;
use yii\helpers\VarDumper;
use yii\helpers\FileHelper;
use Yii;


class ImageUploadAction extends UploadAction
{
    public $pathRes;

    public $urlRes;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        if ($this->urlRes === null)
            $this->urlRes = $this->url;
        if ($this->pathRes === null)
            $this->urlRes = $this->path;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $result = parent::run();
        if (isset($result['error'])) return $result;
        if (!isset($result['filename']))
        	$filename = substr($result['filelink'], strrpos($result['filelink'], '/') + 1);
        else
        	$filename = $result['filename'];
        
        //Resize
		Image::thumbnail($this->path . $filename, 240, 400)
			->save(Yii::getAlias($this->pathRes . $filename), ['quality' => 90]);
        
        copy(Yii::getAlias($this->pathRes . $filename), Yii::getAlias('@backend/web/images/content/') . $filename);
		
		$result['filelink'] = $this->urlRes . $filename;
        
        return $result;
    }
}
