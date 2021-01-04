<?php

namespace api\modules\v1\controllers;


use api\modules\v1\models\ApiResponse;
use api\modules\v1\models\Posts;
use api\modules\v1\models\Report;
use api\modules\v1\models\Settings;
use api\modules\v1\models\User;
use api\modules\v1\models\Verifications;
use Yii;
use yii\data\ActiveDataProvider;
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
            "total_points" => Yii::$app->user->identity->wallet_balance,
            "new_tweets" => Posts::find()->andWhere('created_at >= DATE_SUB(NOW(),INTERVAL 1 HOUR)')->count(),
            "tweets_today" => Posts::find()->andWhere(['DATE(created_at)' => date('Y-m-d')])->count(),
            "points_today" => rand(0, 1000),
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

    public function actionSubmitVerification()
    {
        if (Verifications::find()->where(['user_id' => Yii::$app->user->id])->exists()) {
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'Verification submitted!');
        }

        $model = new Verifications();
        $model->user_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post();
        if (!$model->validate()) {
            return (new ApiResponse)->error($model->getErrors(), ApiResponse::VALIDATION_ERROR);
        }

        User::updateAll(['country' => $model->country], ['id' => Yii::$app->user->id]);

        if (!$model->save())
            return (new ApiResponse)->error($model, ApiResponse::UNABLE_TO_PERFORM_ACTION);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionMyVerification()
    {
        if (!$model = Verifications::find()->where(['user_id' => Yii::$app->user->id])->one()) {
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'No verification submitted');
        }

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionDeleteVerification()
    {
        if (!$model = Verifications::find()->where(['user_id' => Yii::$app->user->id])->one()) {
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'No verification submitted');
        }

        return (new ApiResponse)->success($model->delete(), ApiResponse::SUCCESSFUL);
    }

    public function actionProfileImage()
    {
        $image = Yii::$app->request->post('image');

        if (empty($image))
            return (new ApiResponse)->error(null, ApiResponse::VALIDATION_ERROR, 'Image cannot be empty');

        $model = User::findOne(['id' => Yii::$app->user->id]);
        $model->image_path = $image;
        if (!$model->update())
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'Could not update image');


        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionSearch($search)
    {

        $query = Posts::find()->orFilterWhere(['like', 'content', '%' . $search . '%', false]);

        $provider = new ActiveDataProvider([
            'query' => $query->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
                'validatePage' => false,
            ],
        ]);

        if ($provider->totalCount > 0)
            return (new ApiResponse)->success($provider->getModels(), ApiResponse::SUCCESSFUL, 'Search result', $provider);
        return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT, 'No result');

    }

    public function actionReportPost($type)
    {
        $model = new Report();
        $model->user_id = Yii::$app->user->id;
        $model->type = $type;
        $model->attributes = Yii::$app->request->post();
        if (!$model->validate()) {
            return (new ApiResponse)->error($model->getErrors(), ApiResponse::VALIDATION_ERROR);
        }

        if (!Posts::find()->where(['id' => $model->reference_id])->exists()) {
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'Post id is not valid');
        }

        if (Report::find()->where(['user_id' => Yii::$app->user->id, 'reference_id' => $model->reference_id, 'report_status' => 0])->exists()) {
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'Already reported this post');
        }

        if (!$model->save())
            return (new ApiResponse)->error($model, ApiResponse::UNABLE_TO_PERFORM_ACTION);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionDeleteAccount()
    {
        if ($model = User::find()->where(['AND', ['id' => Yii::$app->user->id], ['<>', 'status', 0]])->one()) {
            $model->status = 0;
            $model->token = null;
            if ($model->save())
                return true;
        }
        return false;
    }
}

