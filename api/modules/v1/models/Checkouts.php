<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "checkouts".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $user_id
 * @property float $amount
 * @property float $current_balance
 * @property string $message
 * @property string $preferred_choice
 * @property int $approval_status
 */
class Checkouts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checkouts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'message'], 'safe'],
            [['user_id', 'amount', 'current_balance', 'preferred_choice'], 'required'],
            [['amount', 'current_balance'], 'number'],
            [['preferred_choice'], 'string'],
            [['approval_status','user_id'], 'integer'],
            [['message'], 'string', 'max' => 191],
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
            'current_balance' => 'Current Balance',
            'message' => 'Message',
            'preferred_choice' => 'Preferred Choice',
            'approval_status' => 'Approval Status',
        ];
    }
}