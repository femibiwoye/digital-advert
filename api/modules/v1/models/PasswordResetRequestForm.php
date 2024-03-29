<?php

namespace api\modules\v1\models;

use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            //['email', 'email', 'message' => 'Provide a valid email address.'],
            ['email', 'string', 'min' => 8, 'max' => 64],
            ['email', 'match', 'pattern' => "/^[@a-zA-Z0-9.\/_-]+$/", 'message' => "Email can only contain letters, numbers or any of these special characters [/@._-]"],
            //['email', 'exist', 'targetClass' => User::className()],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::find()
            ->where(['OR', ['phone' => $this->email], ['email' => $this->email]])
            ->one();

        if (!$user) {
            return false;
        }

        //if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
        //}

        if (!$user->save(false)) {
            return false;
        }

//        $notification = new InputNotification();
//        $notification->NewNotification('request_password_reset', [['user_id', $user->id]]);

        return $user->password_reset_short_code; //To be returned
//        return true;
    }
}
