<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Posts;

/**
 * PostsSearch represents the model behind the search form of `common\models\Posts`.
 */
class PostsSearch extends Posts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'owner_id', 'approved', 'multiple_file', 'paid_post', 'created_by', 'updated_by', 'approved_by'], 'integer'],
            [['title', 'slug', 'content', 'platform', 'file', 'post_token', 'payment_status', 'created_at', 'updated_at'], 'safe'],
            [['advert_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Posts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'owner_id' => $this->owner_id,
            'approved' => $this->approved,
            'multiple_file' => $this->multiple_file,
            'paid_post' => $this->paid_post,
            'advert_amount' => $this->advert_amount,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'approved_by' => $this->approved_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'platform', $this->platform])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'post_token', $this->post_token])
            ->andFilterWhere(['like', 'payment_status', $this->payment_status]);

        return $dataProvider;
    }
}
