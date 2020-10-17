<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_file".
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property string $file_name
 * @property string $extension
 * @property int $status
 * @property string $created_at
 *
 * @property Posts $post
 * @property User $user
 */
class PostFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'post_id', 'file_name', 'extension'], 'required'],
            [['id', 'user_id', 'post_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['file_name'], 'string', 'max' => 200],
            [['extension'], 'string', 'max' => 45],
            [['id'], 'unique'],
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
            'file_name' => 'File Name',
            'extension' => 'Extension',
            'status' => 'Status',
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
