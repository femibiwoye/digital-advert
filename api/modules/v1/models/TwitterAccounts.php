<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "twitter_accounts".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $user_id
 * @property int $twitter_id
 * @property string $oauth_token
 * @property string $oauth_token_secret
 */
class TwitterAccounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'twitter_accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'twitter_id', 'oauth_token', 'oauth_token_secret'], 'required'],
            [['user_id', 'twitter_id'], 'integer'],
            [['oauth_token', 'oauth_token_secret'], 'string'],
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
            'twitter_id' => 'Twitter ID',
            'oauth_token' => 'Oauth Token',
            'oauth_token_secret' => 'Oauth Token Secret',
        ];
    }
}