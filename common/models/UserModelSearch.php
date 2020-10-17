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
            [['id', 'email_verified', 'profile_verified', 'status', 'is_boarded'], 'integer'],
            [['username', 'first_name', 'middle_name', 'last_name', 'phone', 'email', 'image', 'type', 'auth_key', 'password_hash', 'password_reset_token', 'verification_token', 'oauth_provider', 'oauth_uid', 'token', 'token_expires', 'last_accessed', 'created_at', 'updated_at'], 'safe'],
            [['wallet', 'previous_wallet'], 'number'],
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
            'wallet' => $this->wallet,
            'previous_wallet' => $this->previous_wallet,
            'email_verified' => $this->email_verified,
            'profile_verified' => $this->profile_verified,
            'status' => $this->status,
            'token_expires' => $this->token_expires,
            'last_accessed' => $this->last_accessed,
            'is_boarded' => $this->is_boarded,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'oauth_provider', $this->oauth_provider])
            ->andFilterWhere(['like', 'oauth_uid', $this->oauth_uid])
            ->andFilterWhere(['like', 'token', $this->token]);

        return $dataProvider;
    }
}
