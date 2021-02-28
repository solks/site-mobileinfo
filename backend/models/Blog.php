<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use backend\models\Tag;
use backend\components\myInflector;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $intro
 * @property string $content
 * @property string $preview_img
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * @property Comment[] $comments
 * @property TblUser $author
 */
class Blog extends \yii\db\ActiveRecord
{
    public $imageFile;

    public $img = [];

    // Filepath to save uploaded image
    public $filePath = '@frontend/web/images/blog';
    public $fileUrl = '/images/blog';
    public $originFolder = 'origin';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'intro'], 'required'],
            [['intro', 'content'], 'string'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title', 'alias', 'preview_img'], 'string', 'max' => 128],
            [['imageFile'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'alias' => 'Alias',
            'intro' => 'Описание',
            'content' => 'Cодержание',
            'preview_img' => 'Изображение',
            'status' => 'Статус',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'author_id']);
    }

    public function afterFind()
	{
		parent::afterFind();

		$this->removeAds();
	}

    public function beforeSave($insert)
	{
    	if (!parent::beforeSave($insert)) {
			return false;
		}

	    if ($insert) {
	    	$this->create_time = $this->update_time = time();
	    	//$this->author_id=Yii::app()->user->id;
	    } else
	    	$this->update_time = time();

	    if ($this->alias == '') {
	    	//Yii::$classMap['mycomponents\myInflector'] = '@vendor/mycomponents/myInflector.php';
			$this->alias = myInflector::slug($this->title);
		}

		if ($this->imageFile) {
			$this->img['src'] = substr($this->imageFile->name, 0, strrpos($this->imageFile->name, '.'));
			$this->resizeImage();
			$this->preview_img = json_encode($this->img);
		}

		$this->insertAds();

		//$baseUrl = Yii::$app->params['baseUrl'];

	    return true;
	}

	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);
		//Yii::info(print_r($changedAttributes, true));
	}

	public function afterDelete()
	{
		parent::afterDelete();
	}

	// Resize and save image
	public function resizeImage()
	{
		if ($this->imageFile) {
			$fileName = $this->imageFile->name;
			$this->imageFile->saveAs(Yii::getAlias($this->filePath).'/'.$this->originFolder.'/'.$fileName);

			$image_src = Image::getImagine()->open(Yii::getAlias($this->filePath).'/'.$this->originFolder.'/'.$fileName);

			$w_src = $image_src->getSize()->getWidth();
			$h_src = $image_src->getSize()->getHeight();
			$this->img['width'] = $w_src;
			$this->img['height'] = $h_src;

			if ($h_src > 200) {
				$h = 200;
				$w = ceil($h * $w_src / $h_src);

				//Resize
				$image_src->thumbnail(new Box($w, $h), ManipulatorInterface::THUMBNAIL_OUTBOUND)
					->save(Yii::getAlias(Yii::getAlias($this->filePath).'/'.$fileName), ['quality' => 94]);
				//Small thumb
				$image_src->thumbnail(new Box(13, 10), ManipulatorInterface::THUMBNAIL_OUTBOUND)
					->save(Yii::getAlias(Yii::getAlias($this->filePath).'/thumb/'.$fileName), ['quality' => 90]);

				$this->img['width'] = $w;
				$this->img['height'] = $h;
			}
		}
	}

	public function insertAds() {
		$ads = '<!-- Ads -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- infosmartphone_headline -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5001158605331260"
     data-ad-slot="1238632070"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<!-- EndAds -->';

		$this->content = preg_replace('#<!--\s*Ads\s*-->#isu', $ads, $this->content);
	}

	public function removeAds() {
		$this->content = preg_replace('#<!-- Ads -->.+?<!-- EndAds -->#isu', '<!-- Ads -->', $this->content);
	}
}
