<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $post_id
 * @property integer $cont_id
 * @property integer $idx
 * @property string $src
 * @property integer $width
 * @property integer $height
 * @property string $alt
 *
 * @property Image $image
 */
class PostImage extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'image';
    }

    public function rules()
    {
        return [
            [['src', 'width', 'height'], 'required'],
            [['post_id', 'cont_id', 'idx', 'width', 'height'], 'integer'],
            [['src', 'alt'], 'string', 'max' => 128],
        ];
    }

    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'cont_id' => 'Content ID',
            'idx' => 'Image index',
            'src' => 'Image src',
			'width' => 'Image Width',
			'height' => 'Image Height',
            'alt' => 'Image alt',
        ];
    }
}
