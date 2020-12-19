<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $payment_reference_code
 * @property int $user_id
 * @property string $full_name
 * @property float $amount
 * @property string $type
 * @property string $email
 * @property string $phone_number
 * @property string $address
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['payment_reference_code', 'user_id', 'full_name', 'amount', 'type'], 'required'],
            [['user_id'], 'integer'],
            [['amount'], 'number'],
            [['payment_reference_code', 'full_name', 'type', 'email', 'phone_number', 'address'], 'string', 'max' => 191],
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
            'payment_reference_code' => 'Payment Reference Code',
            'user_id' => 'User ID',
            'full_name' => 'Full Name',
            'amount' => 'Amount',
            'type' => 'Type',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
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