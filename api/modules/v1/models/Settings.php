<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $key_word
 * @property string $value
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
            [['created_at', 'updated_at'], 'safe'],
            [['key_word', 'value'], 'required'],
            [['key_word', 'value'], 'string', 'max' => 191],
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
            'key_word' => 'Key Word',
            'value' => 'Value',
        ];
    }
}