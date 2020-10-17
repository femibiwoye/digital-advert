<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $key_word
 * @property string $value
 * @property string $created_at
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key_word', 'value'], 'required'],
            [['created_at'], 'safe'],
            [['key_word', 'value'], 'string', 'max' => 45],
            [['key_word'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key_word' => 'Key Word',
            'value' => 'Value',
            'created_at' => 'Created At',
        ];
    }
}
