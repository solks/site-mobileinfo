<?php

namespace backend\models;

use Yii;
use backend\components\myInflector;
use backend\models\Tag;
use backend\models\PostImage;
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

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    public function getPostImages()
    {
        return $this->hasMany(PostImage::className(), ['post_id' => 'id'])
        	->indexBy(function ($row) { return $row['cont_id'].'-'.$row['idx'];})->asArray();
    }

    public function getAuthor()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'author_id']);
    }

    public function afterFind()
	{
		parent::afterFind();

		for ($i=1; $i<4; $i++) {
			$images = array_filter($this->postImages, function ($k) use ($i) { return (int) $k[0] == $i; }, ARRAY_FILTER_USE_KEY);
			// add images to content
			if(isset($images))  {
				$this->{'cont'.$i} .= "\n";
				foreach ($images as $img) {
					$this->{'cont'.$i} .= Html::img(
						Yii::$app->params['baseUrl'].'/images/content/'.$img['src'].'.jpg',
						['alt' => $img['alt']]
					);
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
    	    	$this->alias = myInflector::slug($this->title);
			}

			$tagsArr = array_unique(explode(',', $this->tags));
			foreach ($tagsArr as $key => $tag)
				$tagsArr[$key] = myInflector::slug(trim($tag));
			$this->t_tags = implode(', ', $tagsArr);

			$this->images = '';

			for ($i=1; $i<4; $i++) {
				$n = -1;
				if (preg_match_all('#<img[^>]+>#isu', $this->{'cont'.$i}, $imageTags, PREG_PATTERN_ORDER)) {
        			foreach ($imageTags[0] as $n => $tag) {
        				preg_match('#src="[^"]*\/([^"\/]+)\.([\w]+)"#isu', $tag, $src);
        				preg_match('#alt="([^"]*)"#isu', $tag, $alt);
						$size = getimagesize(Yii::getAlias('@frontend/web/images/content/').$src.'.jpg');

						if (($imageModel = PostImage::findOne(['post_id' => $this->id, 'cont_id' => $i, 'idx' => $n])) == null)
							$imageModel = new PostImage(['post_id' => $this->id, 'cont_id' => $i, 'idx' => $n]);

        				$imageModel->src = $src[1];
        				$imageModel->alt = $alt[1];
						$imageModel->width = $size[0];
			            $imageModel->height = $size[1];

        				if (!$imageModel->save()) return false;
        			}

					//delete image from content
					$this->{'cont'.$i} = preg_replace('#<img[^>]+>#isu', '',  $this->{'cont'.$i});
					$this->{'cont'.$i} = preg_replace('#<p>\s*?</p>#isu', '',  $this->{'cont'.$i});
				}

				//clear excess db records
				$imageRecords = PostImage::find()->where(['post_id' => $this->id])
					->andWhere(['cont_id' => $i])
					->andWhere(['>', 'idx', $n])
					->all();
		        foreach ($imageRecords as $record)
							$record->delete();
			}

    	    return true;
    	} else {
    	    return false;
    	}
	}

	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

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
