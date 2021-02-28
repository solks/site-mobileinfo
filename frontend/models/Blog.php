<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

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
 */
class Blog extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'blog';
    }

    public function rules()
    {
        return [
            [['title', 'intro'], 'required'],
            [['intro', 'content'], 'string'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title', 'alias', 'preview_img'], 'string', 'max' => 128]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'intro' => 'Intro',
            'content' => 'Content',
            'preview_img' => 'Preview Img',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'author_id' => 'Author ID',
        ];
    }

    public function getUrl()
    {
    	return Url::to(['blog/view', 'id' => $this->id, 'title' => $this->alias]);
    }
}
