<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wallet_history".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type Debit is amount taken out of the balance and credit is amount added to the balance.
 * @property float $old_balance
 * @property float $new_balance
 * @property string $operation
 * @property string $ip
 * @property string $created_at
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
            [['user_id', 'old_balance', 'new_balance', 'operation', 'ip'], 'required'],
            [['user_id'], 'integer'],
            [['type', 'operation'], 'string'],
            [['old_balance', 'new_balance'], 'number'],
            [['created_at'], 'safe'],
            [['ip'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'old_balance' => 'Old Balance',
            'new_balance' => 'New Balance',
            'operation' => 'Operation',
            'ip' => 'Ip',
            'created_at' => 'Created At',
        ];
    }
}
