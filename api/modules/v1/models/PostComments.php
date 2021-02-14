<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "post_comments".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $user_id
 * @property string $post_id
 * @property string $comment
 * @property string $type
 * @property string $value_earned
 * @property string $media
 * @property string $tweet_id
 * @property string $raw
 * @property int|null $status
 */
class PostComments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'media', 'value_earned', 'status', 'raw'], 'safe'],
            [['user_id', 'post_id', 'comment', 'type'], 'required'],
            [['type', 'tweet_id'], 'string'],
            [['post_id', 'user_id'], 'integer'],
            [['comment', 'value_earned'], 'string', 'max' => 191],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'id']],
            ['media', 'validateMedia']
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        //$fields['poster'] = 'poster';

        if (($key = array_search('raw', $fields)) !== false) unset($fields[$key]);

        return $fields;
    }

    public function validateMedia()
    {
        if (is_array($this->media))
            return true;

        $this->addError('media', 'Media must be an array');
        return false;
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
            'post_id' => 'Post ID',
            'comment' => 'Comment',
            'type' => 'Type',
            'value_earned' => 'Value Earned',
            'media' => 'Media',
        ];
    }

    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'post_id'])->andWhere(['is_posted_to_twitter' => 1]);
    }

    public function getPoster()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->select(['id','name','image_path','twitter_id','username']);
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