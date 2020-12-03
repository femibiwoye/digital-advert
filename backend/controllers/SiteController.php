<?php

namespace backend\controllers;

use backend\models\Admin;
use common\models\AdminLoginForm;
use common\models\Checkouts;
use common\models\Posts;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $analytics = [
            ['number' => Admin::find()->count(), 'title' => 'Admin Count', 'url' => '#'],
            ['number' => User::find()->count(), 'title' => 'Users Count', 'url' => '#'],
            ['number' => User::find()->where(['verification_status' => 1])->count(), 'title' => 'Verified Users', 'url' => '#'],
            ['number' => Posts::find()->count(), 'title' => 'Total Posts', 'url' => '#'],
            ['number' => Posts::find()->where(['is_approved' => 1])->count(), 'title' => 'Approved Posts', 'url' => '#'],
            ['number' => Checkouts::find()->count(), 'title' => 'Checkout', 'url' => '#'],
            ['number' => 0, 'title' => 'Total Money Paid', 'url' => '#'],
            ['number' => 0, 'title' => 'Total Comments', 'url' => '#'],
        ];

        return $this->render('index', ['analytics' => $analytics]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            //$this->layout = 'auth';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
