<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $user_id
 * @property string $content
 * @property string $media
 * @property string $platforms
 * @property int $is_approved
 * @property int $is_promoted
 * @property int $comment_count
 * @property int $like_count
 * @property int $boost_amount
 * @property string $tweet_id
 * @property string $retweet_post_id
 * @property int $is_posted_to_twitter
 * @property string|null $raw
 * @property string|null $start_at
 * @property string|null $end_at
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'media', 'platforms'], 'safe'],
            [['user_id', 'content', 'media', 'platforms'], 'required'],
            [['user_id', 'is_approved', 'is_promoted', 'comment_count', 'like_count', 'boost_amount', 'is_posted_to_twitter'], 'integer'],
            [['content', 'raw','start_at','end_at'], 'string'],
            [['tweet_id', 'retweet_post_id'], 'string', 'max' => 191],
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
            'content' => 'Content',
            'media' => 'Media',
            'platforms' => 'Platforms',
            'is_approved' => 'Is Approved',
            'is_promoted' => 'Is Promoted',
            'comment_count' => 'Comment Count',
            'like_count' => 'Like Count',
            'boost_amount' => 'Boost Amount',
            'tweet_id' => 'Tweet ID',
            'retweet_post_id' => 'Retweet Post ID',
            'is_posted_to_twitter' => 'Is Posted To Twitter',
            'raw' => 'Raw',
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
