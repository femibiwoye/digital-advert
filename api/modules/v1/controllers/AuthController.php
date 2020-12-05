<?php

namespace api\modules\v1\controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use api\components\Utility;
use Yii;
use api\modules\v1\models\{Login, User, ApiResponse, PasswordResetRequestForm, ResetPasswordForm};
use yii\helpers\ArrayHelper;
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
            'only' => ['logout'],
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
        $response = $connection->oauth("oauth/request_token", ["oauth_callback" => Yii::$app->params['apiDomain'] . "/twitter_callback?h=23"]);

        $oauth_token = $response["oauth_token"];
        //$oauth_token_secret = $response["oauth_token_secret"];

        $url = $connection->url("oauth/authorize", ["oauth_token" => $oauth_token]);
        return $url;
    }

    public function actionAuthenticateTwitterUser($oauth_token,$oauth_verifier)
    {
        $connection = Utility::TwitterConnection();
//        $oauth_token = $request->input("oauth_token");
//        $oauth_verifier = $request->input("oauth_verifier");
        $response = $connection->oauth("oauth/access_token", ["oauth_token" => $oauth_token, "oauth_verifier" => $oauth_verifier]);

        $oauth_token = $response["oauth_token"];
        $oauth_token_secret = $response["oauth_token_secret"];
        $connection = new TwitterOAuth(Yii::$app->params['TwitterConsumerKey'], Yii::$app->params['TwitterConsumerSecret'], $oauth_token, $oauth_token_secret);

        $userDetails = $connection->get("account/verify_credentials");
        $profilePic = $userDetails->profile_image_url_https;
        $name = $userDetails->name;
        $handle = $userDetails->screen_name;

        $ID = $userDetails->id;
        return $userDetails;

//        //$user = User::where("twitter_id", $ID)->first(); if($user == null)
//        User::truncate();
//        $user = User::create(["id"=>1, "twitter_id" => $ID, "name"=>$name, "username"=>$handle, "image_path"=>$profilePic]);
//
//        TwitterAccount::create(["user_id" => $user->id, "oauth_token" => $oauth_token, "oauth_token_secret" => $oauth_token_secret]);
//
//        //create user access token
//        $token =  $user->createToken( env("APP_NAME") )->accessToken;
//
//        return redirect(env("CLOSE_WINDOW_URL")."?data=$token,$profilePic,$handle,$name");
    }
}

