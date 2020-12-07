<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "verifications".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $user_id
 * @property string $verification_method
 * @property string $verification_media
 * @property int $status
 * @property string $verified_by
 */
class Verifications extends \yii\db\ActiveRecord
{
    public $country;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'verification_media'], 'safe'],
            [['user_id', 'verification_method', 'verification_media'], 'required'],
            [['verification_method'], 'string'],
            [['status','user_id'], 'integer'],
            [['verified_by', 'country'], 'string', 'max' => 191],
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
            'verification_method' => 'Verification Method',
            'verification_media' => 'Verification Media',
            'status' => 'Status',
            'verified_by' => 'Verified By',
        ];
    }
}