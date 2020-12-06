<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "banks".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $user_id
 * @property string $bank_name
 * @property string $account_name
 * @property string $account_number
 * @property int $approval_status
 */
class Banks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'bank_name', 'account_name', 'account_number'], 'required'],
            [['user_id', 'approval_status'], 'integer'],
            [['bank_name', 'account_name', 'account_number'], 'string', 'max' => 191],
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
            'bank_name' => 'Bank Name',
            'account_name' => 'Account Name',
            'account_number' => 'Account Number',
            'approval_status' => 'Approval Status',
        ];
    }
}