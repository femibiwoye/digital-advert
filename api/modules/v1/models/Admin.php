<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property string $position
 * @property string|null $image
 * @property string $level
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BankList[] $bankLists
 * @property BankList[] $bankLists0
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name', 'auth_key', 'password_hash', 'email', 'position', 'level', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['level'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'image'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['position'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'position' => 'Position',
            'image' => 'Image',
            'level' => 'Level',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[BankLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBankLists()
    {
        return $this->hasMany(BankList::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[BankLists0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBankLists0()
    {
        return $this->hasMany(BankList::className(), ['updated_by' => 'id']);
    }
}