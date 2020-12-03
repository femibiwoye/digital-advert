<?php

namespace frontend\modules\affiliate\controllers;

use common\models\UserModel;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `affiliate` module
 */
class DefaultController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $dashboard = [
            'allAffiliate' => ['count' => UserModel::find()->where(['affiliate_id' => \Yii::$app->user->id])->count(), 'url' => '#', 'title' => 'Affiliated Users', 'icon' => 'users', 'sign' => null],
            'currentBalance' => ['count' => \Yii::$app->user->identity->wallet_balance, 'url' => '#', 'title' => 'Current Balance', 'icon' => 'cash', 'sign' => '&#8358;']
        ];
        return $this->render('index', ['dashboard' => $dashboard]);
    }
}
