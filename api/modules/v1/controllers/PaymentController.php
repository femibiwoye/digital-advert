<?php

namespace api\modules\v1\controllers;


use api\modules\v1\models\ApiResponse;
use api\modules\v1\models\BankList;
use api\modules\v1\models\Banks;
use api\modules\v1\models\Checkouts;
use api\modules\v1\models\Payments;
use api\modules\v1\models\WalletHistories;
use Yii;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;


/**
 * Amazon controller
 */
class PaymentController extends Controller
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

    public function actionCreatePayment()
    {
        $model = new Payments();
        $model->user_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post();
        if (!$model->validate()) {
            return (new ApiResponse)->error($model->getErrors(), ApiResponse::VALIDATION_ERROR);
        }

        if (!$model->save())
            return (new ApiResponse)->error($model, ApiResponse::UNABLE_TO_PERFORM_ACTION);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionWalletHistory()
    {
        $model = WalletHistories::find()->where(['user_id' => Yii::$app->user->id])->all();

        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionCreateCheckout()
    {
        $model = new Checkouts();
        $model->user_id = Yii::$app->user->id;
        $model->current_balance = Yii::$app->user->identity->wallet_balance;
        $model->attributes = Yii::$app->request->post();
        if (!$model->validate()) {
            return (new ApiResponse)->error($model->getErrors(), ApiResponse::VALIDATION_ERROR);
        }

        if (!$model->save())
            return (new ApiResponse)->error($model, ApiResponse::UNABLE_TO_PERFORM_ACTION);

        if (Yii::$app->user->identity->wallet_balance < $model->amount) {
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'Insufficient balance');
        }

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionGetCheckout()
    {
        $model = Checkouts::find()->where(['user_id' => Yii::$app->user->id])->all();

        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionMyBank()
    {
        $model = Banks::findOne(['user_id' => Yii::$app->user->id]);
        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionCreateBank()
    {
        if (Banks::find()->where(['user_id' => Yii::$app->user->id])->exists()) {
            return (new ApiResponse)->error(null, ApiResponse::UNABLE_TO_PERFORM_ACTION, 'Bank already added!');
        }

        $model = new Banks();
        $model->user_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post();
        if (!$model->validate()) {
            return (new ApiResponse)->error($model->getErrors(), ApiResponse::VALIDATION_ERROR);
        }

        if (!$model->save())
            return (new ApiResponse)->error($model, ApiResponse::UNABLE_TO_PERFORM_ACTION);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }

    public function actionBankList()
    {
        $model = BankList::findAll(['status' => 1]);

        if (!$model)
            return (new ApiResponse)->error(null, ApiResponse::NO_CONTENT);

        return (new ApiResponse)->success($model, ApiResponse::SUCCESSFUL);
    }
}

