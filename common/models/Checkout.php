<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "checkout".
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property float $current_balance
 * @property string $preferred_choice
 * @property int|null $approval_status When admin change status to 0, it means it is declined, if it is 1, it means it is approved.
 * @property int|null $approved_by
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property User $user
 * @property CheckoutMessage[] $checkoutMessages
 */
class Checkout extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checkout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'amount', 'current_balance', 'preferred_choice'], 'required'],
            [['id', 'user_id', 'approval_status', 'approved_by'], 'integer'],
            [['amount', 'current_balance'], 'number'],
            [['preferred_choice'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'amount' => 'Amount',
            'current_balance' => 'Current Balance',
            'preferred_choice' => 'Preferred Choice',
            'approval_status' => 'Approval Status',
            'approved_by' => 'Approved By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[CheckoutMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckoutMessages()
    {
        return $this->hasMany(CheckoutMessage::className(), ['checkout_id' => 'id']);
    }
}
