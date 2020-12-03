<?php

namespace frontend\modules\affiliate\controllers;

use common\models\User;
use common\models\Referrer;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `affiliate` module
 */
class ReferralController extends Controller
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

        $dataProvider  = new \yii\data\ActiveDataProvider([
            'query' => Referrer::find()->where(['user_id' => Yii::$app->user->id])
        ]);

        return $this->render('index', [
            //'searchModel' => $searchModel,
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

        $dataProvider  = new \yii\data\ActiveDataProvider([
            'query' => User::find()->innerJoin('affiliate_log log')->
            where(['log.affiliate_code' => $this->findModel($id)->code, 
            'log.affiliate_id' => Yii::$app->user->id])
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Referrer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Referrer();

        if ($model->load(Yii::$app->request->post())) {

            $check_referrer_code = Referrer::find()->where(['code' => $model->code])->one();

            if(!$check_referrer_code){
                $model->user_id = Yii::$app->user->id;
                $model->save();

                Yii::$app->session->setFlash('success', 'Referral Code Created!');
                return $this->redirect(['view', 'id' => $model->id]);
            }

            
            Yii::$app->session->setFlash('warning', 'Referral Code alredy Exist!');
            return $this->redirect(['default']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    

    /**
     * Deletes an existing Referrer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        $affiliateCode = Referrer::find()->innerJoin('affiliate_log log')->where([
            'log.affiliate_code' => $id
            ]);

        if(!$affiliateCode->exists()){

            $this->findModel($this->findModel(Referrer::find()->where(['code' => $id])->one()->id))->delete();

            Yii::$app->session->setFlash('success', 'Referral Code deleted successfully!');
            return $this->redirect(['index']);
        }
        

        Yii::$app->session->setFlash('danger', 'Cannot be deleted! Record(s) has used this code.');
        return $this->redirect(['view', 'id' => Referrer::find()->where(['code' => $id])->one()->id]);    
        
    }

    /**
     * Finds the Referrer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Referrer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Referrer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
