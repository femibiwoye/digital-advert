<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserModel;

/**
 * UserModelSearch represents the model behind the search form of `common\models\UserModel`.
 */
class UserModelSearch extends UserModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_admin', 'verification_status', 'status', 'affiliate_id'], 'integer'],
            [['remember_token', 'created_at', 'updated_at', 'name', 'email', 'email_verified_at', 'phone_number', 'password', 'twitter_id', 'username', 'image_path', 'auth_key', 'phone', 'token'], 'safe'],
            [['wallet_balance'], 'number'],
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
        $query = UserModel::find();

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
            'is_admin' => $this->is_admin,
            'wallet_balance' => $this->wallet_balance,
            'verification_status' => $this->verification_status,
            'email_verified_at' => $this->email_verified_at,
            'status' => $this->status,
            'affiliate_id' => $this->affiliate_id,
        ]);

        $query->andFilterWhere(['like', 'remember_token', $this->remember_token])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'twitter_id', $this->twitter_id])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'image_path', $this->image_path])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'token', $this->token]);

        return $dataProvider;
    }
}
