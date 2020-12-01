<?php

namespace app\modules\v1\models;


use Yii;
use yii\base\Model;

class SignupForm extends Model
{

    public $first_name;
    public $last_name;
    public $phone;
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['first_name', 'last_name','username', 'password'], 'required'],
            [['first_name', 'last_name', 'password'], 'filter', 'filter' => 'trim'],

            ['email', 'trim'],
            ['email', 'email', 'message' => 'Provide a valid email address'],
            ['email', 'string', 'min' => 8, 'max' => 50],
            ['email', 'unique', 'targetClass' => 'app\modules\v2\models\User', 'message' => 'This email address has already been taken.'],
            ['email', 'match', 'pattern' => "/^[@a-zA-Z0-9+._-]+$/", 'message' => "Email can only contain letters, numbers or any of these special characters [@._-]"],

            ['phone', 'trim'],
            ['phone', 'unique', 'targetClass' => 'app\modules\v1\models\User', 'message' => 'This phone number has already been taken.'],
            ['phone', 'string', 'min' => 11, 'max' => 14],
            ['phone', 'match', 'pattern' => '/(^[0]\d{10}$)|(^[\+]?[234]\d{12}$)/'],

            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * This is the main signup starting point
     *
     * @param $type
     * @return User|bool
     * @throws \yii\db\Exception
     */
    public function signup($type)
    {
        $user = new User;
        $user->firstname = $this->first_name;
        $user->lastname = $this->last_name;
        if (!empty($this->phone))
            $user->phone = $this->phone;
        $user->type = $type;
        if (!empty($this->email))
            $user->email = $this->email;
        $user->class = $this->class;
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