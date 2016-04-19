<?php

namespace backend\models;

use Yii;
use backend\components\myInflector;
use backend\models\Tag;
use yii\helpers\Html;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $category
 * @property string $intro
 * @property string $cont1
 * @property string $cont2
 * @property string $cont3
 * @property string $video
 * @property string $preview_img
 * @property string $tags
 * @property string $t_tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * @property Comment[] $comments
 * @property TblUser $author
 */
class Post extends \yii\db\ActiveRecord
{
    private $_oldTags;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category', 'cont1', 'status'], 'required'],
            [['intro', 'cont1', 'cont2', 'cont3', 'tags', 't_tags'], 'string'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title', 'alias', 'category'], 'string', 'max' => 128],
            [['video'], 'string', 'max' => 16]
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
            'category' => 'Категория',
            'intro' => 'Описание',
            'cont1' => 'Шаг 1',
            'cont2' => 'Шаг 2',
            'cont3' => 'Шаг 3',
            'images' => 'Content imageg',
            'video' => 'Youtube видео',
            'tags' => 'Теги',
            't_tags' => 'T Tags',
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
		
		$images = explode(';', $this->images);
		
		for ($i=1; $i<4; $i++) {
			if(isset($images[$i-1]) and $images[$i-1] != '')  {
				
				$cont_images = explode(',', $images[$i-1]);
				
				$this->{'cont'.$i} .= "\n";
				foreach ($cont_images as $img) {
					$this->{'cont'.$i} .= ' '.Html::img(Yii::$app->params['baseUrl'].'/images/content/'.$img);
				}
			}
		}
		
	}
    
    public function beforeSave($insert)
	{
    	if (parent::beforeSave($insert)) {
    	    if ($insert) {
    	    	$this->create_time=$this->update_time=time();
    	    	//$this->author_id=Yii::app()->user->id;
    	    } else
    	    	$this->update_time=time();
    	    
    	    if($this->alias == '') {
    	    	//Yii::$classMap['mycomponents\myInflector'] = '@vendor/mycomponents/myInflector.php';
				$this->alias = myInflector::slug($this->title);
			}
			
			$tagsArr = array_unique(explode(',', $this->tags));
			foreach ($tagsArr as $key => $tag)
				$tagsArr[$key] = myInflector::slug(trim($tag));
			$this->t_tags = implode(', ', $tagsArr);
			
			$this->images = '';
			
			$baseUrl = Yii::$app->params['baseUrl'];
			for ($i=1; $i<4; $i++) {
				if (preg_match_all("#<img[^>]*?src=\"{$baseUrl}/images/content/([^\"]*?)\"[^>]*?>#isu", $this->{'cont'.$i}, $images)) {
					if ($i > 1) $this->images .= ';';
					$this->images .= implode(',', $images[1]);
					$this->{'cont'.$i} = preg_replace('#<img[^>]+?>#isu', '',  $this->{'cont'.$i});
					$this->{'cont'.$i} = preg_replace('#<p>\s*?</p>#isu', '',  $this->{'cont'.$i});
				}
			}
    	    
    	    return true;
    	} else {
    	    return false;
    	}
	}
	
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);
		//Yii::info(print_r($changedAttributes, true));
		
		$tagModel = new Tag;
		$tagModel->category = $this->category;
		if (isset($changedAttributes['tags'])) {
			$tagModel->updateFrequency($changedAttributes['tags'], $this->tags);
		} else 
			$tagModel->updateFrequency('', $this->tags);
	}
	
	public function afterDelete()
	{
		parent::afterDelete();
		
		$tagModel = new Tag;
		$tagModel->category = $this->category;
		$tagModel->updateFrequency($this->tags, '');
	}
}
