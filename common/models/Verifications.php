<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "verifications".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $user_id
 * @property string $verification_method
 * @property string $verification_media
 * @property int $status
 * @property string $verified_by
 */
class Verifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'verification_method', 'verification_media'], 'required'],
            [['verification_method', 'verification_media'], 'string'],
            [['status', 'verified_by'], 'integer'],
            [['user_id'], 'string', 'max' => 191],
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    public function getAdmin(){
        return $this->hasOne(Admin::className(),['id'=>'verified_by']);
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
            'verification_method' => 'Verification Method',
            'verification_media' => 'Verification Media',
            'status' => 'Status',
            'verified_by' => 'Verified By',
        ];
    }

    public function sendEmail($user, $message,$status)
{
    return Yii::$app->mailer->compose(['html'=>'layouts/verification'],['content'=>$message])
        ->setTo($user->email)
        ->setFrom([Yii::$app->params['supportEmail'] =>Yii::$app->params['emailSender']])
        ->setSubject('Your verification is '. $status)
        ->setTextBody($user->name. ' ' .' here is your ' . $status . ' mail here ' . $message . ' etc.')
        ->send();
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
