<?php

namespace app\models;

use Yii;

class Stat extends yii\base\Model
{
    public static function tableName()
    {
        return 'stat';
    }

    public function rules()
    {
        return [
            [['hits'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hits' => 'Hits',
        ];
    }

    public static function getHits($id)
    {
        $hits = Yii::$app->db->createCommand()
			->select('hits')
			->from(self::tableName())
			->where('id = :id', [':id' => $id])
			->scalar();
		
		return $hits;
    }
    
    public static function increment($id)
	{
		$query = 'INSERT INTO '.self::tableName().' (id, hits) VALUES ('.$id.', 1) ON DUPLICATE KEY UPDATE hits = hits + 1';
		
		return Yii::$app->db->createCommand($query)->execute();
	}
	
	public static function decrement($id)
	{
		$query = 'INSERT INTO '.self::tableName().' (id, hits) VALUES ('.$id.', 1) ON DUPLICATE KEY UPDATE hits = hits - 1';
		
		return Yii::$app->db->createCommand($query)->execute();
	}
}
