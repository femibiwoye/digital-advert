<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $position
 * @property string $image
 * @property string $level
 * @property integer $created_at
 * @property integer $updated_at
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password_repeat;

    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name', 'auth_key', 'password_hash', 'email', 'position', 'level', 'created_at', 'updated_at'], 'required'],
            [['image'], 'safe'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['level'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'image'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['position'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'position' => 'Position',
            'image' => 'Image',
            'level' => 'Level',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function Signup()
    {
        //if ($this->validate()) {
        $admin = new \common\models\Admin();

        // Get the instance of the upload file
        $this->image = UploadedFile::getInstance($this, 'image');
        if (!empty($this->image) && $this->image->size > 0) {
            $imageName = $this->username . '.' . $this->image->extension;
            $this->image->saveAs('img/admin/' . $imageName);

            // Save the path in the db column
            $admin->image = $imageName;
        }


        $admin->username = $this->username;
        $admin->name = $this->name;
        $admin->email = $this->email;
        $admin->position = $this->position;
        $admin->status = $this->status;
        $admin->level = $this->level;
        $admin->setPassword($this->password_hash);
        $admin->generateAuthKey();
        if ($admin->save()) {
            return $admin;
        }
        //}

        return null;
    }
}
