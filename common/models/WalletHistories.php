<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wallet_histories".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $user_id
 * @property string $type
 * @property float $old_balance
 * @property float $new_balance
 * @property string $operation
 * @property string $IP
 */
class WalletHistories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallet_histories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'type', 'old_balance', 'new_balance', 'IP'], 'required'],
            [['type'], 'string'],
            [['old_balance', 'new_balance'], 'number'],
            [['user_id', 'operation', 'IP'], 'string', 'max' => 191],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'type' => 'Type',
            'old_balance' => 'Old Balance',
            'new_balance' => 'New Balance',
            'operation' => 'Operation',
            'IP' => 'Ip',
        ];
    }
    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('y-m-d H-i-s');
        } else {
            $this->updated_at = date('y-m-d H-i-s');
        }
        return parent::beforeSave($insert);
    }
}
