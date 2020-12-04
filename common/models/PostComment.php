<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_comment".
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property string|null $comment
 * @property string $type
 * @property string|null $file
 * @property string|null $file_type
 * @property float|null $value_earned
 * @property string|null $created_at
 *
 * @property Posts $post
 * @property User $user
 */
class PostComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'type'], 'required'],
            [['user_id', 'post_id'], 'integer'],
            [['comment', 'type', 'file_type'], 'string'],
            [['value_earned'], 'number'],
            [['created_at'], 'safe'],
            [['file'], 'string', 'max' => 200],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'id']],
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
            'post_id' => 'Post ID',
            'comment' => 'Comment',
            'type' => 'Type',
            'file' => 'File',
            'file_type' => 'File Type',
            'value_earned' => 'Value Earned',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'post_id']);
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
