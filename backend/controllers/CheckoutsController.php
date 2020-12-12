<?php

namespace backend\controllers;

use Yii;
use common\models\Checkouts;
use common\models\CheckoutsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\WalletHistories;
use common\models\Payments;
use common\models\User;

/**
 * CheckoutsController implements the CRUD actions for Checkouts model.
 */
class CheckoutsController extends Controller
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
     * Lists all Checkouts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CheckoutsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Checkouts model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->preferred_choice == 'wallet') {

            $preferred_choice = WalletHistories::findOne(['reference_id' => $model->payment_id]);
            return $this->render('view', ['model' => $model, 'preferred_choice' => $preferred_choice]);

        } else {
        $preferred_choice = Payments::findOne(['id' => $model->payment_id]);
        return $this->render('view', ['model' => $model, 'preferred_choice' => $preferred_choice]);
    }

    }

    /**
     * Creates a new Checkouts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Checkouts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Checkouts model.
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


    public function actionApprove($id)
    {

        $model = $this->findModel($id);
        $user = User::findOne(['id' => $model->user_id]);
        $wallet = new WalletHistories();

        $model->approval_status = 1;
        $model->approved_by = Yii::$app->user->id;

        //wallet balance
        $old_balance = $user->wallet_balance;

        $current_balance = ($old_balance - $model->amount);
        $model->current_balance = $current_balance;
        $user->wallet_balance = $current_balance;

        $wallet->user_id = $model->user_id;
        $wallet->old_balance = $old_balance;
        $wallet->new_balance = $current_balance;
        $wallet->amount = $model->amount;
        $wallet->IP = Yii::$app->request->userIP;

        //save to database
        $model->save();
        $user->save();
        $wallet->save(false);

        if ($model->preferred_choice == 'wallet') {
            $preferred_choice = WalletHistories::findOne(['reference_id' => $model->id]);
            return $this->redirect(['view', 'id' => $model->id, 'preferred_choice' => $preferred_choice]);

        } else if ($model->preferred_choice == 'card' || 'bank') {
            $preferred_choice = Payments::findOne(['id' => $model->id]);
            return $this->redirect(['view', 'id' => $model->id, 'preferred_choice' => $preferred_choice]);

        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Checkouts model.
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
     * Finds the Checkouts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Checkouts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Checkouts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
