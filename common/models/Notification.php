<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string $description
 * @property string $generality
 * @property int|null $admin_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'admin_id'], 'integer'],
            [['title', 'description', 'generality'], 'required'],
            [['description', 'generality'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 50],
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
            'title' => 'Title',
            'description' => 'Description',
            'generality' => 'Generality',
            'admin_id' => 'Admin ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
