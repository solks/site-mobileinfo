<?php

namespace backend\components;

use vova07\imperavi\actions\UploadFileAction;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;
use Imagine\Image\Box;
use Imagine\Image\Point;
use yii\helpers\VarDumper;
use yii\helpers\FileHelper;
use Yii;


class ImageUploadAction2 extends UploadFileAction
{
    public $pathRes;

    public $urlRes;

    public $filename;

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
    public function run() {
        $result = parent::run();
        if (isset($result['error'])) return $result;
        if (!isset($result['filename']))
        	$this->filename = substr($result['filelink'], strrpos($result['filelink'], '/') + 1);
        else
        	$this->filename = $result['filename'];

        $src_path = $this->path.$this->filename;
		$image_src = Image::getImagine()->open($src_path);

        $w_src = $image_src->getSize()->getWidth();
		$h_src = $image_src->getSize()->getHeight();

		if (preg_match('/.*?Default-tpl.*?/isu', $this->filename)) {
			$this->makeimage($image_src->thumbnail(new Box(203, 361)), 'Default-tpl.png', new Box(203, 361), new Box(228, 426),  new Point(12, 31));
		} elseif ($w_src > 450) {
			$w = 450;
			$h = ceil($w * $h_src / $w_src);
			//Resize
			$image_src->thumbnail(new Box($w, $h), ManipulatorInterface::THUMBNAIL_OUTBOUND)
				->save(Yii::getAlias($this->pathRes.$this->filename), ['quality' => 94]);
		} else
			$image_src->save(Yii::getAlias($this->pathRes.$this->filename), ['quality' => 94]);

		//Small thumb
		//$image_src->thumbnail(new Box(75, 75), ManipulatorInterface::THUMBNAIL_OUTBOUND)
		//	->save(Yii::getAlias($this->pathRes.'thumb/'.$this->filename), ['quality' => 92]);

		copy(Yii::getAlias($this->pathRes.$this->filename), Yii::getAlias('@backend/web/images/blog/').$this->filename);

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
		// $image->thumbnail(new Box(9, 17))->save($thumb_path, ['quality' => 90]);
    }
}
