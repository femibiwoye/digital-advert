<?php

namespace frontend\modules\affiliate\controllers;

use common\components\ConvertImage;
use common\models\User;
use common\models\UserModel;
use common\models\UsersModel;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `affiliate` module
 */
class BusinessController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = User::findOne(Yii::$app->user->id);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => User::find()->where(['is_admin' => 0, 'affiliate_id' => $user->id])
        ]);

        return $this->render('businesses', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Coupon model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => User::findOne($id),
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionPaidBusiness()
    {

        $dataProvider = new \yii\data\ActiveDataProvider([

            'query' => User::find()->innerJoin('posts p')->where([
                'users.id' => 'p.user_id',
                'is_approved' => 1,
                'is_promoted' => 1,
                'affiliate_id' => Yii::$app->user->id
            ])
        ]);

        return $this->render('paid-businesses', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionUnpaidBusiness()
    {


        $dataProvider = new \yii\data\ActiveDataProvider([

            'query' => User::find()->innerJoin('posts p')->where([
                'is_approved' => 0,
                'boost_amount' => 0,
                'users.id' => 'p.user_id',
                'affiliate_id' => Yii::$app->user->id
            ])
        ]);

        return $this->render('unpaid-businesses', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Renders the amount earned view for the module
     * @return string
     */
    public function actionAmountEarned()
    {

        $amount = WalletHistory::find()->aliase('wh')->innerJoin('posts p')
                  ->where([
                      'wh.user_id' => Yii::$app->user->id, 
                      'p.id' => 'wh.reference_id', 
                      'wh.reference_type' => 'ad'
                    ])
                  ->one();

        return $amount->new_balance;          
    }
}
