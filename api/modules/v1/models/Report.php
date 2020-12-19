<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property int $id
 * @property int $user_id
 * @property int $reference_id
 * @property string $type
 * @property string $message
 * @property int|null $report_status 1 means report has been attended to or fixed.
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'reference_id', 'type', 'message'], 'required'],
            [['user_id', 'reference_id', 'report_status'], 'integer'],
            [['type', 'message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
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
            'reference_id' => 'Reference ID',
            'type' => 'Type',
            'message' => 'Message',
            'report_status' => 'Report Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}