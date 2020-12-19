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
 * @property int $post_id
 * @property float $amount
 * @property float $current_balance
 * @property string $message
 * @property string $preferred_choice
 * @property int $approval_status
 * @property int $payment_id
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
            [['user_id', 'amount', 'current_balance', 'preferred_choice', 'post_id', 'payment_id', 'message'], 'required'],
            [['amount', 'current_balance'], 'number'],
            [['preferred_choice'], 'string'],
            [['approval_status', 'user_id'], 'integer'],
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

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
        }

        return parent::beforeSave($insert);
    }
}