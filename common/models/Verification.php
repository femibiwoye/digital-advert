<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "verification".
 *
 * @property int $id
 * @property int $user_id
 * @property string $verification_method
 * @property string|null $verification_file
 * @property int $status
 * @property int $verified_by
 *
 * @property User $user
 */
class Verification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'verification_method', 'verified_by'], 'required'],
            [['user_id', 'status', 'verified_by'], 'integer'],
            [['verification_method'], 'string'],
            [['verification_file'], 'string', 'max' => 200],
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
            'verification_method' => 'Verification Method',
            'verification_file' => 'Verification File',
            'status' => 'Status',
            'verified_by' => 'Verified By',
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
}
