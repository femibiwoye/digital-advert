<?php

namespace api\modules\v1\controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use api\components\Utility;
use api\modules\v1\models\TwitterAccounts;
use common\models\UserModel;
use Yii;
use api\modules\v1\models\{Login, User, ApiResponse, PasswordResetRequestForm, ResetPasswordForm};
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;


/**
 * Auth controller
 */
class AuthController extends Controller
{


    public function behaviors()
    {
        $behaviors = parent::behaviors();

        //For CORS
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        //$behaviors['authenticator'] = $auth;
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['logout', 'user'],
        ];

        return $behaviors;
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        $model = new Login;
        $model->attributes = Yii::$app->request->post();
        if ($model->validate() && $user = $model->login()) {
            $user->updateAccessToken();
            if ($user->type == 'school')
                $user = array_merge(ArrayHelper::toArray($user), Utility::getSchoolAdditionalData($user->id));
            return (new ApiResponse)->success($user, null, 'Login is successful');
        } else {
            return (new ApiResponse)->error($model->getErrors(), ApiResponse::NON_AUTHORITATIVE, 'You provided invalid login details');
        }
    }

    /**
     * Signup action
     *
     * @param $type
     * @return ApiResponse
     * @throws \yii\db\Exception
     */
    public function actionSignup($type)
    {
        if (!in_array($type, SharedConstant::ACCOUNT_TYPE)) {
            return (new ApiResponse)->error(null, ApiResponse::NOT_FOUND, 'This is an unknown user type');
        }

        $form = new SignupForm(['scenario' => "$type-signup"]);
        $form->attributes = Yii::$app->request->post();
        if (!$form->validate()) {
            return (new ApiResponse)->error($form->getErrors(), ApiResponse::UNABLE_TO_PERFORM_ACTION);
        }

        if (!$user = $form->signup($type)) {
            return (new ApiResponse)->error($form->getErrors(), ApiResponse::UNABLE_TO_PERFORM_ACTION, 'User is not created successfully');
        }

        $user->updateAccessToken();
        if ($user->type == 'school')
            $user = array_merge(ArrayHelper::toArray($user), Utility::getSchoolAdditionalData($user->id));


        return (new ApiResponse)->success($user, null, 'You have successfully signed up as a' . $type);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $model = new User;
        if (!$model->resetAccessToken()) {
            return (new ApiResponse)->error(null, ApiResponse::UNAUTHORIZED);
        }

        return (new ApiResponse)->success('User is successfully logout');
    }

    /**
     *This is first step in requesting password to be changed.
     * @return ApiResponse
     */
    public function actionForgotPassword()
    {
        $form = new PasswordResetRequestForm();
        $form->attributes = Yii::$app->request->post();
        if (!$form->validate()) {
            return (new ApiResponse)->error($form->getErrors(), ApiResponse::UNABLE_TO_PERFORM_ACTION);
        }

        if (!$form->sendEmail()) {
            return (new ApiResponse)->error(null, ApiResponse::UNAUTHORIZED);
        }

        return (new ApiResponse)->success(null, ApiResponse::SUCCESSFUL, 'Email successfully sent');
    }

    /**
     * Updating with new password
     * @return ApiResponse
     */
    public function actionResetPassword()
    {
        $form = new ResetPasswordForm;
        $form->attributes = Yii::$app->request->post();
        if (!$form->validate()) {
            return (new ApiResponse)->error($form->getErrors(), ApiResponse::UNABLE_TO_PERFORM_ACTION);
        }

        if (!$form->resetPassword()) {
            return (new ApiResponse)->error(null, ApiResponse::UNAUTHORIZED);
        }

        return (new ApiResponse)->success(null, ApiResponse::SUCCESSFUL, 'Password successfully changed');
    }

    public function actionToken($token)
    {
        return $token;

    }

    public function actionTwitterAuthorization()
    {

        $connection = Utility::TwitterConnection();
        $response = $connection->oauth("oauth/request_token", ["oauth_callback" => Yii::$app->params['apiDomain'] . "/twitter_callback"]);

        $oauth_token = $response["oauth_token"];
        //$oauth_token_secret = $response["oauth_token_secret"];

        $url = $connection->url("oauth/authorize", ["oauth_token" => $oauth_token]);
        return $this->redirect($url);
    }


    public function actionAuthenticateTwitterUser($oauth_token, $oauth_verifier)
    {

        try {
            $connection = Utility::TwitterConnection();
//        $oauth_token = $request->input("oauth_token");
//        $oauth_verifier = $request->input("oauth_verifier");
            $response = $connection->oauth("oauth/access_token", ["oauth_token" => $oauth_token, "oauth_verifier" => $oauth_verifier]);

            $oauth_token = $response["oauth_token"];
            $oauth_token_secret = $response["oauth_token_secret"];
            $connection = new TwitterOAuth(Yii::$app->params['TwitterConsumerKey'], Yii::$app->params['TwitterConsumerSecret'], $oauth_token, $oauth_token_secret);

            $userDetails = $connection->get("account/verify_credentials");

            if ($model = User::findOne(['twitter_id' => $userDetails->id])) {
                $this->saveLastTwitterToken($model, $oauth_token, $oauth_verifier);
                return $this->redirect(Yii::$app->params['apiDomainBase'] . '/closeWindow.html?token=' . $model->updateAccessToken());
            } else {
                $model = new User();
                $model->twitter_id = $userDetails->id;
                $model->image_path = $userDetails->profile_image_url_https;
                $model->username = $userDetails->screen_name;
                $model->name = $userDetails->name;
                $model->generateAuthKey();
                $location = explode(',', $userDetails->location, 2);
                if (isset($location[0]))
                    $model->state = $location[0];
                if (isset($location[1]))
                    $model->country = $location[1];
                $model->about = $userDetails->description;
                if ($model->save()) {
                    $this->saveLastTwitterToken($model, $oauth_token, $oauth_verifier);
                    return $this->redirect(Yii::$app->params['apiDomainBase'] . '/closeWindow.html?token=' . $model->token);
                }
            }
        } catch (\Exception $e) {
            return (new ApiResponse)->error($e, ApiResponse::SUCCESSFUL, 'Error occur in server');
        }
        return (new ApiResponse)->error(null, ApiResponse::REQ, 'Not successful');
    }

    private function saveLastTwitterToken($model, $oauth_token, $oauth_verifier)
    {
        $twitterModel = new TwitterAccounts();
        $twitterModel->twitter_id = $model->twitter_id;
        $twitterModel->user_id = $model->id;
        $twitterModel->oauth_token = $oauth_token;
        $twitterModel->oauth_token_secret = $oauth_verifier;
        return $twitterModel->save();
    }

    public function actionUser()
    {
        return (new ApiResponse)->success(User::findOne(['id' => Yii::$app->user->id]));
    }

    public function actionActiveStatus($token)
    {
        if (!$token)
            return (new ApiResponse)->error(null, ApiResponse::UNAUTHORIZED, 'Token is required');

        return User::find()->where(['token' => $token])->one() ? true : false;
    }
}

