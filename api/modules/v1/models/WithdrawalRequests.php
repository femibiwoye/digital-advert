<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "withdrawal_requests".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $user_id
 * @property string $amount
 * @property string $method
 */
class WithdrawalRequests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'withdrawal_requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'amount', 'method'], 'required'],
            [['method'], 'string'],
            [['user_id'], 'integer'],
            [['amount'], 'double'],
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
            'amount' => 'Amount',
            'method' => 'Method',
        ];
    }
}