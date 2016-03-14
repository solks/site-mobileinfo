<?php

namespace backend\models;

use Yii;
use backend\components\myInflector;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property string $t_name
 * @property string $category
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 't_name', 'category'], 'required'],
            [['frequency'], 'integer'],
            [['name', 't_name', 'category'], 'string', 'max' => 128],
            [['t_name', 'category'], 'unique', 'targetAttribute' => ['t_name', 'category'], 'message' => 'The combination of T Name and Category has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            't_name' => 'T Name',
            'category' => 'Category',
            'frequency' => 'Frequency',
        ];
    }
    
    public static function string2array($tags) {
		return preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
	}
    
    public function updateFrequency($oldTags, $newTags) {
		$oldTags = self::string2array($oldTags);
		$newTags = self::string2array($newTags);
		$this->addTags(array_values(array_diff($newTags,$oldTags)));
		$this->removeTags(array_values(array_diff($oldTags,$newTags)));
	}
	
	public function addTags($tags) {
		foreach($tags as $name) {
			if (!$this->updateAllCounters(['frequency' => 1], ['name' => $name, 'category' => $this->category])) {
				$tag = new Tag;
				$tag->name = $name;
				$tag->t_name = myInflector::slug($name);
				$tag->category = $this->category;
				$tag->frequency = 1;
				$tag->save();
			}
		}
	}
	
	public function removeTags($tags) {
		if(empty($tags)) return;
		$this->updateAllCounters(['frequency' => -1], ['name' => $tags, 'category' => $this->category]);
		$this->deleteAll('frequency <= 0');
	}
}
