<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $post_id
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 *
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    public $verifyCode;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'author'], 'required'],
            [['post_id', 'id', 'status', 'create_time'], 'integer'],
            [['content'], 'string'],
            [['author'], 'string', 'max' => 128],
            [['verifyCode'], 'captcha', 'captchaAction' => 'post/captcha']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post',
            'id' => 'ID',
            'content' => 'Комментарий',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'author' => 'Имя',
			'verifyCode' => 'Код проверки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
