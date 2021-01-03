<?php

namespace api\modules\v1\controllers;


use api\modules\v1\models\ApiResponse;
use api\modules\v1\models\Notification;
use api\modules\v1\models\Posts;
use api\modules\v1\models\Settings;
use api\modules\v1\models\User;
use api\modules\v1\models\Verifications;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;


/**
 * Amazon controller
 */
class NotificationController extends Controller
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
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        $model = Notification::find()
            ->where(['generality' => ['general', 'affiliate']])
            ->orWhere(['user_id' => Yii::$app->user->id])
            ->all();

        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionViewStatus($id)
    {
        $model = Notification::find()
            ->where(['id' => $id, 'generality' => ['general', 'affiliate']])
            ->orWhere(['user_id' => Yii::$app->user->id])->one();
        if ($model) {
            $model->view_status = 1;
            if ($model->save()) {
                return (new ApiResponse)->success(true, ApiResponse::SUCCESSFUL);
            } else {
                return (new ApiResponse)->success(false, ApiResponse::SUCCESSFUL);
            }
        }

        return (new ApiResponse)->success(null, ApiResponse::SUCCESSFUL);
    }
}

