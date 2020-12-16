<?php

namespace backend\controllers;

use common\models\Banks;
use Yii;
use common\models\WithdrawalRequests;
use common\models\WithdrawalRequestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\WalletHistories;
use common\models\User;
/**
 * WithdrawalRequestsController implements the CRUD actions for WithdrawalRequests model.
 */
class WithdrawalRequestsController extends Controller
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
                        'allow' => (!\Yii::$app->user->isGuest && Yii::$app->user->identity->level == 'super') ? true : false,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all WithdrawalRequests models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new WithdrawalRequestsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WithdrawalRequests model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $user_balance = User::findOne(['id'=>$model->user_id]);
        $account_balance = Banks::findOne(['user_id'=>$model->user_id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'user_balance' => $user_balance,
            'account_balance' => $account_balance,
        ]);
    }

    /**
     * Creates a new WithdrawalRequests model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WithdrawalRequests();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionApprove($id)
    {
       
        $model = $this->findModel($id);
        $user = User::findOne(['id' => $model->user_id]);
        $wallet = new WalletHistories();
            
            if($user->wallet_balance >= $model->amount){
                //old balance
                $old_balance = $user->wallet_balance;
        
                //new balance
                $new_amount = ($user->wallet_balance - $model->amount);
                $new_balance = $new_amount;

                $user->wallet_balance = $new_balance;

                $wallet->user_id = $model->user_id;
                $wallet->old_balance = $old_balance;
                $wallet->new_balance = $new_balance;
                $wallet->amount = $model->amount;

                //save records
                $user->save();
                $wallet->save(false);
                Yii::$app->session->setFlash('success', "Withdrawal Approved!");
            }else
              Yii::$app->session->setFlash('error', "Not enough funds!"); 
        return $this->render('view', [
            'model' => $model,
        ]);
    }



    /**
     * Updates an existing WithdrawalRequests model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WithdrawalRequests model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WithdrawalRequests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return WithdrawalRequests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WithdrawalRequests::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
