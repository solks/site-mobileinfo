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

	public function parceTag($tag) {
		$data = ['src' => '', 'alt' => '', 'width' => 0, 'height' => 0];

		preg_match('#src="[^"]*\/([^"\/]+)\.([\w]+)"#isu', $tag, $src);
		preg_match('#alt="([^"]*)"#isu', $tag, $alt);
		$data['src'] = $src[1];
		if (isset($alt[1]))
			$data['alt'] = $alt[1];

		$size = getimagesize(Yii::getAlias('@frontend/web/images/content/').$src[1].'.jpg');
		$data['width'] = $size[0];
		$data['height'] = $size[1];

		return $data;
	}

	public function updateRecords($images)
	{
		$count = count($images);

		if ($count == 1) {
			$imageData = $this->parceTag($images[0]);

			$this->src = $imageData['src'];
			$this->alt = $imageData['alt'];
			$this->width = $imageData['width'];
			$this->height = $imageData['height'];

			if (!$this->save()) return false;

		} elseif ($count > 1) {
			foreach ($images as $n => $image) {
				$imageData = $this->parceTag($image);

				$model = new PostImage(['post_id' => $this->post_id, 'cont_id' => $this->cont_id, 'idx' => $n]);

				$model->src = $imageData['src'];
				$model->alt = $imageData['alt'];
				$model->width = $imageData['width'];
				$model->height = $imageData['height'];

				if (!$model->save()) return false;
			}
		}

		//clear excess db records
		$maxIdx = $count-1;
		$this->deleteAll("`post_id` = $this->post_id and `cont_id` = $this->cont_id and `idx` > $maxIdx");
	}
}
