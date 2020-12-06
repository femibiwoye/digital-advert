<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "post_likes".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $user_id
 * @property string $post_id
 * @property int $like_status
 */
class PostLikes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_likes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'post_id'], 'required'],
            [['like_status'], 'integer'],
            [['user_id', 'post_id'], 'string', 'max' => 191],
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
            'like_status' => 'Like Status',
        ];
    }
}