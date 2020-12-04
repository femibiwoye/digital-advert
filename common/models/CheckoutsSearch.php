<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Checkouts;

/**
 * CheckoutsSearch represents the model behind the search form of `common\models\Checkouts`.
 */
class CheckoutsSearch extends Checkouts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'approval_status'], 'integer'],
            [['created_at', 'updated_at', 'user_id', 'message', 'preferred_choice'], 'safe'],
            [['amount', 'current_balance'], 'number'],
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
        $query = Checkouts::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'amount' => $this->amount,
            'current_balance' => $this->current_balance,
            'approval_status' => $this->approval_status,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'preferred_choice', $this->preferred_choice]);

        return $dataProvider;
    }
}
