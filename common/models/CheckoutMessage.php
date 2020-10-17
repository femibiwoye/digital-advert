<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "checkout_message".
 *
 * @property int $id
 * @property int $user_id
 * @property int $checkout_id
 * @property string $message
 * @property int $approved_by
 * @property string $created_at
 *
 * @property Checkout $checkout
 * @property User $user
 */
class CheckoutMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checkout_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'checkout_id', 'message', 'approved_by'], 'required'],
            [['user_id', 'checkout_id', 'approved_by'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['checkout_id'], 'exist', 'skipOnError' => true, 'targetClass' => Checkout::className(), 'targetAttribute' => ['checkout_id' => 'id']],
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
            'checkout_id' => 'Checkout ID',
            'message' => 'Message',
            'approved_by' => 'Approved By',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Checkout]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckout()
    {
        return $this->hasOne(Checkout::className(), ['id' => 'checkout_id']);
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
}
