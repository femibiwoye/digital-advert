<?php

namespace api\modules\v1\models;


use api\modules\v1\models\User;
use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $phone;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['name', 'phone', 'password', 'email'], 'required'],
            [['name', 'email', 'password'], 'filter', 'filter' => 'trim'],

            ['email', 'trim'],
            ['email', 'email', 'message' => 'Provide a valid email address'],
            ['email', 'string', 'min' => 8, 'max' => 50],
            ['email', 'unique', 'targetClass' => 'api\modules\v1\models\User', 'message' => 'This email address has already been taken.'],
            ['email', 'match', 'pattern' => "/^[@a-zA-Z0-9+._-]+$/", 'message' => "Email can only contain letters, numbers or any of these special characters [@._-]"],

            ['phone', 'trim'],
            ['phone', 'unique', 'targetClass' => 'api\modules\v1\models\User', 'message' => 'This phone number has already been taken.'],
            ['phone', 'string', 'min' => 11, 'max' => 14],
            ['phone', 'match', 'pattern' => '/(^[0]\d{10}$)|(^[\+]?[234]\d{12}$)/'],

            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * This is the main signup starting point
     *
     * @return User|bool
     * @throws \yii\db\Exception
     */
    public function signup()
    {
        $user = new User();
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generatePasswordResetToken();
        $user->generateAuthKey();
        $dbtransaction = Yii::$app->db->beginTransaction();
        try {
            if (!$user->save()) {
                return false;
            }

            $dbtransaction->commit();
        } catch (\Exception $e) {
            $dbtransaction->rollBack();
            return false;
        }

        return $user;
    }
}