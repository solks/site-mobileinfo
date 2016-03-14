<?php

namespace app\models;

use Yii;
use yii\helpers\Url;


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
 * @property string $atags
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
            [['title', 'alias', 'category', 'cont1', 'status', 'author_id'], 'required'],
            [['intro', 'cont1', 'cont2', 'cont3', 'tags', 't_tags'], 'string'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title', 'alias', 'category', 'preview_img'], 'string', 'max' => 128],
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
            'title' => 'Title',
            'alias' => 'Alias',
            'category' => 'Category',
            'intro' => 'Intro',
            'cont1' => 'Cont1',
            'cont2' => 'Cont2',
            'cont3' => 'Cont3',
            'video' => 'Video',
            'preview_img' => 'Preview Img',
            'tags' => 'Tags',
            't_tags' => 'Atags',
            'status' => 'Status',
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
        return $this->hasMany(Comment::className(), ['post_id' => 'id'])
        	->asArray();
    }
    
    public function getCommentCount()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id'])
        	->count();
    }
    public function getCountry()
	{
		return $this->hasOne(Category::className(), ['cat_alias' => 'category']);
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'author_id']);
    }
    
    public function getUrl()
	{
		return Url::to(['post/view', 'category'=>$this->category, 'id'=>$this->id, 'title'=>$this->alias]);
	}
	
	public function getActiveTags()
	{
		$links = array();
		$tags = array_combine(explode(', ', $this->tags), explode(', ', $this->t_tags));
		foreach($tags as $key => $val)
			$tags[$key] = Url::to(array('post/index', 'category'=>$this->category, 'tag'=>$val));
		return $tags;
	}
}
