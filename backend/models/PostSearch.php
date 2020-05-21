<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Post;

/**
 * PostSearch represents the model behind the search form about `backend\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title', 'alias', 'category', 'intro', 'cont1', 'cont2', 'cont3', 'video', 'tags', 't_tags'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find()->orderBy('create_time DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'cont1', $this->cont1])
            ->andFilterWhere(['like', 'cont2', $this->cont2])
            ->andFilterWhere(['like', 'cont3', $this->cont3])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 't_tags', $this->t_tags]);

        return $dataProvider;
    }
}
