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
            [['created_at', 'updated_at', 'media', 'value_earned', 'media'], 'safe'],
            [['user_id', 'post_id', 'comment', 'type'], 'required'],
            [['type'], 'string'],
            [['post_id','user_id'],'integer'],
            [['comment', 'value_earned'], 'string', 'max' => 191],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'id']],
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
            'post_id' => 'Post ID',
            'comment' => 'Comment',
            'type' => 'Type',
            'value_earned' => 'Value Earned',
            'media' => 'Media',
        ];
    }
}