<?php

namespace backend\controllers;

use common\components\UpdateNotification;
use common\models\User;
use Yii;
use common\models\Verifications;
use common\models\VerificationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * VerificationsController implements the CRUD actions for Verifications model.
 */
class VerificationsController extends Controller
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
     * Lists all Verifications models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VerificationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Verifications model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Verifications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Verifications();

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

        if (Yii::$app->request->post('name')) {


            $user->name = Yii::$app->request->post('name');
            $user->verification_status = 1;


            $model->verified_by = Yii::$app->user->id;
            $model->status = 1;
            if ($model->save() && $user->save()) {
                UpdateNotification::widget(['generality' => 'user', 'user_id' => $user->id, 'title' => 'Verification is approved', 'content' => Yii::$app->request->post('message')]);
                if (!empty($user->email)) {
                    $model->sendEmail($user, Yii::$app->request->post('message'), 'Approve');
                    Yii::$app->session->setFlash('success', "Verification Approved!");
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('approve', [
            'model' => $model,
            'user'=>$user
        ]);
    }

    public function actionDecline($id)
    {
        $model = $this->findModel($id);
        $user = User::findOne(['id' => $model->user_id]);

        if (Yii::$app->request->post('message')) {

            $user->verification_status = 0;
            $model->verified_by = Yii::$app->user->id;
            $model->status = 0;
            
            if($model->save() && $user->save()){
                UpdateNotification::widget(['generality' => 'user', 'user_id' => $user->id, 'title' => 'Verification is declined', 'content' => Yii::$app->request->post('message')]);
                if (!empty($user->email)) {
                    $model->sendEmail($user, Yii::$app->request->post('message'), 'Decline');
                    Yii::$app->session->setFlash('error', "Verification Declined!");
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('decline', [
            'model' => $model,
            'user'=>$user
        ]);
    }

    /**
     * Updates an existing Verifications model.
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
     * Deletes an existing Verifications model.
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
     * Finds the Verifications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Verifications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Verifications::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
