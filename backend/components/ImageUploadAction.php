<?php

namespace backend\components;

use Yii;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;
use Imagine\Image\Box;
use Imagine\Image\Point;
use yii\helpers\VarDumper;
use yii\helpers\FileHelper;
use vova07\imperavi\actions\UploadFileAction;


class ImageUploadAction extends UploadFileAction
{
    public $pathRes;

    public $urlRes;

    public $filename;

    public $max_height = 425;

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
        	$this->filename = substr($result['filelink'], strrpos($result['filelink'], '/') + 1);
        else
        	$this->filename = $result['filename'];

        $src = $this->path.$this->filename;
		$image_src = Image::getImagine()->open($src);

        $w_src = $image_src->getSize()->getWidth();
		$h_src = $image_src->getSize()->getHeight();
		$wh_prop = $w_src/$h_src;

		if(preg_match('/.*?Meizu.*?/isu', $this->filename)) {
			$this->makeimage($image_src, 'Meizu-tpl.png', new Box(191, 339), new Box(212, 426),  new Point(11, 44));
		} elseif (preg_match('/.*?Xiaomi.*?/isu', $this->filename)) {
			$this->makeimage($image_src, 'Xiaomi_tpl.png', new Box(204, 362), new Box(226, 426),  new Point(11, 30));
		} elseif (preg_match('/.*?Samsung.*?/isu', $this->filename)) {
			$this->makeimage($image_src, 'Samsung-tpl.png', new Box(192, 341), new Box(215, 426),  new Point(12, 45));
		} elseif (preg_match('/.*?Microsoft.*?/isu', $this->filename)) {
			$this->makeimage($image_src, 'Microsoft-tpl.png', new Box(188, 334), new Box(225, 425),  new Point(18, 50));
		} elseif (preg_match('/.*?Lenovo.*?/isu', $this->filename)) {
			$this->makeimage($image_src, 'Lenovo-tpl.png', new Box(191, 339), new Box(225, 426),  new Point(17, 37));
		} else {
			$image_src->thumbnail(new Box(round($this->max_height*$w_src/$h_src), $this->max_height))
				->save(Yii::getAlias($this->pathRes.$this->filename), ['quality' => 94]);

			//Small thumb
			$image_src->thumbnail(new Box(9, 17))->save(Yii::getAlias($this->pathRes.'thumb/'.$this->filename), ['quality' => 90]);
			//Image::thumbnail($src, 225, 400)->save($destPath, ['quality' => 92]);
		}

		//copy(Yii::getAlias($this->pathRes.$this->filename), Yii::getAlias('@backend/web/images/content/').$this->filename);

        $result['filelink'] = $this->urlRes.$this->filename;

        return $result;
    }

    public function makeimage($image, $template, $screen_size, $img_size, $start_point) {

    	$dest_path = Yii::getAlias($this->pathRes.$this->filename);
		$thumb_path = Yii::getAlias($this->pathRes.'thumb/'.$this->filename);

    	//Resize and applying phone template
    	$resized = $image->thumbnail($screen_size);
		$tpl = Image::getImagine()->open($this->path.$template);

		$imageRes = Image::getImagine()
			->create($img_size)
			->paste($resized, $start_point)
			->paste($tpl, new Point(0, 0))
			->save($dest_path, ['quality' => 94]);

		// Small thumb
		$image->thumbnail(new Box(9, 17))->save($thumb_path, ['quality' => 90]);
    }
}
