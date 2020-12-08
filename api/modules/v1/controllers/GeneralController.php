<?php

namespace api\modules\v1\controllers;


use api\modules\v1\models\ApiResponse;
use api\modules\v1\models\Posts;
use api\modules\v1\models\Settings;
use api\modules\v1\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;


/**
 * Amazon controller
 */
class GeneralController extends Controller
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

    public function actionDashboardStatistics()
    {
        $post = Posts::find()->where(['user_id' => Yii::$app->user->id]);
        $data = [
            "adverts" => $post->andWhere(['is_promoted' => 1, 'is_approved' => 1])->count(),
            "total_posts" => $post->count(),
            "total_reached" => 0,
            "total_points" => 0,
            "new_tweets" => Posts::find()->andWhere('created_at >= DATE_SUB(NOW(),INTERVAL 1 HOUR)')->count(),
            "tweets_today" => Posts::find()->andWhere(['DATE(created_at)' => date('Y-m-d')])->count(),
            "points_today" => 0,
            "tweets_in_total" => Posts::find()->andWhere(['is_promoted' => 1, 'is_approved' => 1])->count(),
            "user" => User::findOne(['id' => Yii::$app->user->id])
        ];
        return (new ApiResponse)->success($data, ApiResponse::SUCCESSFUL);
    }

    public function actionSettings()
    {
        $model = Settings::find()->all();

        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }
}
