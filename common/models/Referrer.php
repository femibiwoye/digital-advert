<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "referrer_code".
 *
 * @property int $id
 * @property string|null $created_at
 * @property int $user_id
 * @property string $code
 */
class Referrer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referrer_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['user_id', 'code',], 'required'],
            [['user_id'], 'integer'],
            [['code'], 'string'],
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
            'user_id' => 'User ID',
            'code' => 'Code',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('y-m-d H-i-s');
        }
        
        return parent::beforeSave($insert);
    }
}
