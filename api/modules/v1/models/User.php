<?php

namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\filters\RateLimitInterface;

class User extends ActiveRecord implements IdentityInterface, RateLimitInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    //public $password;

    public static function tableName()
    {
        return '{{%users}}';
    }

    public function fields()
    {
        $user = [
            'id',
            'wallet_balance',
            'name',
            'username',
            'email' => 'emailAddress',
            'email_verified_at',
            'phone',
            'image_path',
            'status',
            'token',
            'affiliate_id',
            'verification_status',
            'state',
            'country',
            'about',
            'is_boarded',
            'isConnected',
        ];

        if (Yii::$app->controller->id != 'auth') {
            if (($key = array_search('token', $user)) !== false) unset($user[$key]);
        }

        return $user;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function getEmailAddress()
    {
        return empty($this->email) ? 'user' . $this->getId() . '@morerave.com' : $this->email;
    }

    public function getIsConnected()
    {
        return !empty($this->twitter_id) ? 1 : 0;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['AND', ['id' => $id], ['!=', 'status', self::STATUS_DELETED]]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        if ($user = static::find()->where(['AND', ['token' => $token], ['<>', 'status', self::STATUS_DELETED]])->one()) {
            /**
             * This token is expired if expiry date is greater than current time.
             **/
            return $user;

        }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function updateAccessToken()
    {
        $token = Yii::$app->security->generateRandomString(200);
        $this->token = $token;
        if (!$this->save(false)) {
            return false;
        }

        return $this->token;
    }

    public function resetAccessToken()
    {
        $model = static::findOne(['id' => Yii::$app->user->id]);
        if (!$model) {
            return false;
        }

        $model->token = Yii::$app->security->generateRandomString();
        if (!$model->save(false)) {
            return false;
        }

        return true;
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $user = self::find()->andWhere(['password_reset_token' => $token])->one();
        if (!$user) {
            return false;
        }

        return $user->token_expires >= date('Y-m-d h:i:s', time());
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
        date_default_timezone_set("Africa/Lagos");
        $this->token_expires = date('Y-m-d h:i:s', strtotime("+30 minute", time()));
        $this->password_reset_short_code = mt_rand(100000, 999999);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }


    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();

        return $this->auth_key;
    }

    public static function find()
    {
        return parent::find()->andWhere(['<>', 'users.status', self::STATUS_DELETED]);
    }

    public function getRateLimit($request, $action)
    {
        return [$this->rateLimit, 1]; // $rateLimit requests per second
    }

    public function loadAllowance($request, $action)
    {
        return [$this->allowance, $this->allowance_updated_at];
    }

    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        $this->allowance = $allowance;
        $this->allowance_updated_at = $timestamp;
        $this->save();
    }

    //This action is called before saving
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->status = self::STATUS_ACTIVE;
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
        }

        return parent::beforeSave($insert);
    }


}