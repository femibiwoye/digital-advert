<?php

namespace api\modules\v1\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string $description
 * @property string $generality
 * @property int|null $initiator_id
 * @property int|null $is_admin
 * @property int $view_status If user has seen the notification or not
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

    public function fields()
    {
        $fields = parent::fields();

        $fields['user'] = 'user';

        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'initiator_id', 'is_admin', 'view_status'], 'integer'],
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
            'view_status' => 'View Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUser()
    {
        if ($this->is_admin == 1)
            return $this->hasOne(Admin::className(), ['id' => 'initiator_id'])->select([
                'id',
                new Expression("'MoreRave' as username"),
                new Expression("'".Yii::$app->params['s3BaseUrl']."logo-icon.png' as image"),
                new Expression("'1' as verification_status"),
            ])->asArray();
        else
            return $this->hasOne(User::className(), ['id' => 'initiator_id'])->select([
                'id','username','image_path as image','verification_status'
            ])->asArray();
    }
}