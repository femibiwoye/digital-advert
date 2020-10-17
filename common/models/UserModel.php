<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $image
 * @property string $type
 * @property float $wallet
 * @property float $previous_wallet
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property int $email_verified
 * @property int $profile_verified
 * @property int $status 10 for active, 9 for inactive and 0 for deleted
 * @property string|null $verification_token
 * @property string|null $oauth_provider
 * @property string|null $oauth_uid
 * @property string|null $token
 * @property string|null $token_expires
 * @property string|null $last_accessed Last time the website was accessed
 * @property int $is_boarded
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Checkout[] $checkouts
 * @property CheckoutMessage[] $checkoutMessages
 * @property PostComment[] $postComments
 * @property PostFile[] $postFiles
 * @property PostLike[] $postLikes
 * @property Verification[] $verifications
 */
class UserModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'type', 'auth_key', 'password_hash'], 'required'],
            [['type', 'oauth_provider'], 'string'],
            [['wallet', 'previous_wallet'], 'number'],
            [['email_verified', 'profile_verified', 'status', 'is_boarded'], 'integer'],
            [['token_expires', 'last_accessed', 'created_at', 'updated_at'], 'safe'],
            [['username', 'email', 'image', 'password_hash', 'password_reset_token', 'verification_token', 'token'], 'string', 'max' => 255],
            [['first_name', 'middle_name', 'last_name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 25],
            [['auth_key'], 'string', 'max' => 32],
            [['oauth_uid'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['phone'], 'unique'],
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
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'image' => 'Image',
            'type' => 'Type',
            'wallet' => 'Wallet',
            'previous_wallet' => 'Previous Wallet',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email_verified' => 'Email Verified',
            'profile_verified' => 'Profile Verified',
            'status' => 'Status',
            'verification_token' => 'Verification Token',
            'oauth_provider' => 'Oauth Provider',
            'oauth_uid' => 'Oauth Uid',
            'token' => 'Token',
            'token_expires' => 'Token Expires',
            'last_accessed' => 'Last Accessed',
            'is_boarded' => 'Is Boarded',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Checkouts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckouts()
    {
        return $this->hasMany(Checkout::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CheckoutMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckoutMessages()
    {
        return $this->hasMany(CheckoutMessage::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[PostComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostComments()
    {
        return $this->hasMany(PostComment::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[PostFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostFiles()
    {
        return $this->hasMany(PostFile::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[PostLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostLikes()
    {
        return $this->hasMany(PostLike::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Verifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVerifications()
    {
        return $this->hasMany(Verification::className(), ['user_id' => 'id']);
    }
}
