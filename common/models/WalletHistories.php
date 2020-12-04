<?php

namespace common\models;

use Yii;

/**
<<<<<<< HEAD
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
=======
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
>>>>>>> 26ef34db21df7f5565baddf7cef6e35b33d80a1b
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
<<<<<<< HEAD
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'type', 'old_balance', 'new_balance', 'IP'], 'required'],
            [['type'], 'string'],
            [['old_balance', 'new_balance'], 'number'],
            [['user_id', 'operation', 'IP'], 'string', 'max' => 191],
=======
            [['user_id', 'old_balance', 'new_balance', 'operation', 'ip'], 'required'],
            [['user_id'], 'integer'],
            [['type', 'operation'], 'string'],
            [['old_balance', 'new_balance'], 'number'],
            [['created_at'], 'safe'],
            [['ip'], 'string', 'max' => 50],
>>>>>>> 26ef34db21df7f5565baddf7cef6e35b33d80a1b
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
<<<<<<< HEAD
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
=======
>>>>>>> 26ef34db21df7f5565baddf7cef6e35b33d80a1b
            'user_id' => 'User ID',
            'type' => 'Type',
            'old_balance' => 'Old Balance',
            'new_balance' => 'New Balance',
            'operation' => 'Operation',
<<<<<<< HEAD
            'IP' => 'Ip',
=======
            'ip' => 'Ip',
            'created_at' => 'Created At',
>>>>>>> 26ef34db21df7f5565baddf7cef6e35b33d80a1b
        ];
    }
}
