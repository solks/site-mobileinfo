<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $cat_title
 * @property string $cat_alias
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_title', 'cat_alias'], 'required'],
            [['cat_title', 'cat_alias'], 'string', 'max' => 64],
            [['status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
			'cat_title' => 'Category title',
			'cat_alias' => 'Category alias',
            'status' => 'Status',
        ];
    }
}
