<?php

namespace api\modules\v1\models;

use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $confirm_password;
    public $password;
    public $token;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'confirm_password', 'token'], 'required'],
            ['token', 'string'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],
            ['token', function ($attribute, $params, $validator) {
                $this->_user = User::findByPasswordResetToken($this->$attribute);
                if (!$this->_user) {
                    $this->addError($attribute, 'Invalid or Expire Token');
                }
            }],
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        if (!$user->save()) {
            return false;
        }

//        $notification = new InputNotification();
//        $notification->NewNotification('forgot_password', [['user_id', $user->id]]);

        return true;
    }
}
