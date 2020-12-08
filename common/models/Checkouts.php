<?php

namespace common\models;

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
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'amount', 'current_balance', 'message', 'preferred_choice'], 'required'],
            [['amount', 'current_balance'], 'number'],
            [['preferred_choice'], 'string'],
            [['approval_status'], 'integer'],
            [['user_id', 'message'], 'string', 'max' => 191],
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
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
