<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\Admin;
use backend\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
{
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->level != 'super') {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        if (Yii::$app->user->identity->level != 'super') {
            $id = Yii::$app->user->id;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity->level != 'super') {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $model = new Admin();

        if ($model->load(Yii::$app->request->post())) {
            $admin = $model->Signup();
            return $this->redirect(['view', 'id' => $admin->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->level != 'super') {
            $id = Yii::$app->user->id;
            //return $this->redirect(Yii::$app->request->referrer);
        }
        $model = $this->findModel($id);
        $img_name = $model->image;
        if ($model->load(Yii::$app->request->post())) {
            $imageFile = UploadedFile::getInstance($model, 'image');
            if (isset($imageFile->size)) {
                $imageName = $model->username . '.' . $imageFile->extension;
                $imageFile->saveAs('img/admin/' . $imageName);

                // Save the path in the db column
                $model->image = $imageName;
            } else {
                $model->image = $img_name;
            }

            $model->updated_at = time();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->identity->level != 'super') {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
