<?php

namespace common\models;

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
            [['user_id', 'amount'], 'string', 'max' => 191],
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

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('y-m-d H-i-s');
        } else {
            $this->updated_at = date('y-m-d H-i-s');
        }
        return parent::beforeSave($insert);
    }
}
