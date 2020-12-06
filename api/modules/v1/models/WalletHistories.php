<?php

namespace api\modules\v1\models;

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
 * @property float $amount
 * @property string $IP
 * @property string|null $reference_type This could either be ad, topup or any other relevant string
 * @property int|null $reference_id e.g checkout id, post id, etc
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
            [['type', 'reference_type'], 'string'],
            [['old_balance', 'new_balance', 'amount'], 'number'],
            [['reference_id'], 'integer'],
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
            'amount' => 'Amount',
            'IP' => 'Ip',
            'reference_type' => 'Reference Type',
            'reference_id' => 'Reference ID',
        ];
    }
}