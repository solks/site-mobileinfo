<?php

namespace backend\models;

use Yii;
use backend\components\myInflector;
use backend\models\Tag;
use yii\helpers\Html;
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
            [['title', 'status', 'preview_img'], 'required'],
            [['intro', 'content'], 'string'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title', 'alias', 'preview_img'], 'string', 'max' => 128],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
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
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
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
	}
    
    public function beforeSave($insert)
	{
    	if (parent::beforeSave($insert)) {
    	    if ($insert) {
    	    	$this->create_time = $this->update_time = time();
    	    	//$this->author_id=Yii::app()->user->id;
    	    } else
    	    	$this->update_time = time();
    	    
    	    if ($this->alias == '') {
    	    	//Yii::$classMap['mycomponents\myInflector'] = '@vendor/mycomponents/myInflector.php';
				$this->alias = myInflector::slug($this->title);
			}
			
			if ($this->validate('imageFile')) {
				$filePath = Yii::getAlias('@frontend/web/images/blog/');
				$fileName = $this->imageFile->name;
				
				if ($this->validate($this->imageFile)) {
					$this->imageFile->saveAs($filePath.'origin/'.$fileName);
					$image_src = Image::getImagine()->open($filePath.'origin/'.$fileName);
					
					$w_src = $image_src->getSize()->getWidth();
					$h_src = $image_src->getSize()->getHeight();
		
					$h = 200;
					$w = ceil($h * $w_src / $h_src);
					
					//Resize
					$image_src->thumbnail(new Box($w, $h), ManipulatorInterface::THUMBNAIL_OUTBOUND)
						->save(Yii::getAlias($filePath.$fileName), ['quality' => 94]);
					//Small thumb
					$image_src->thumbnail(new Box(75, 75), ManipulatorInterface::THUMBNAIL_OUTBOUND)
						->save(Yii::getAlias($filePath.'thumb/'.$fileName), ['quality' => 92]);
					
					$this->preview_img = '/images/blog/'.$fileName;
				}
			}
			
			//$baseUrl = Yii::$app->params['baseUrl'];			
    	    
    	    return true;
    	} else {
    	    return false;
    	}
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
}
