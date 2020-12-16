<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "referrer_code".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $created_at
 */
class ReferrerCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referrer_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'code'], 'required'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['code'], 'unique'],
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
            'code' => 'Code',
            'created_at' => 'Created At',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    public function getReferralCount(){
        return $this->hasOne(AffiliateLog::className(),['affiliate_code'=>'code'])->count();
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
}
