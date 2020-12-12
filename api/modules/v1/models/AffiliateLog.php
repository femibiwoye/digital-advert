<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "affiliate_log".
 *
 * @property int $id
 * @property int $user_id
 * @property int $affiliate_id
 * @property string $affiliate_code
 * @property string $created_at
 * @property string|null $updated
 */
class AffiliateLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'affiliate_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'affiliate_id', 'affiliate_code'], 'required'],
            [['user_id', 'affiliate_id'], 'integer'],
            [['created_at', 'updated'], 'safe'],
            [['affiliate_code'], 'string', 'max' => 50],
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
            'affiliate_id' => 'Affiliate ID',
            'affiliate_code' => 'Affiliate Code',
            'created_at' => 'Created At',
            'updated' => 'Updated',
        ];
    }
}