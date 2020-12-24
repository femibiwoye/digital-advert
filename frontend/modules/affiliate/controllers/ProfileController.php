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

/**
 * Default controller for the `affiliate` module
 */
class ProfileController extends Controller
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

        $model = User::findOne(['id' => Yii::$app->user->id]);
        $modelCopy = clone $model;
        if ($model->load(Yii::$app->request->post())) {

            $model->image_path = UploadedFile::getInstance($model, 'image_path');

            if ($model->image_path) {
                $s3 = new ConvertImage(['model' => $model->image_path]);
                $imageResponse = $s3->ImageUpload('users');
                if (isset($imageResponse['ObjectURL']) && !empty($imageResponse['ObjectURL'])) {
                    $model->image_path = $imageResponse['ObjectURL'];
                }
            } else {
                $model->image_path = $modelCopy->image_path;
            }
            if ($model->update())
                Yii::$app->session->setFlash('success', 'Profile updated');
            else
                Yii::$app->session->setFlash('danger', 'Could not update profile');
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionPassword()
    {
        $model = UserModel::findOne(['id' => Yii::$app->user->id]);
        $model->scenario = 'password';
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                print_r($model->errors);
                die;
                Yii::$app->session->setFlash('danger', 'Try again');
                return $this->redirect(Yii::$app->request->referrer);
            }
            if (Yii::$app->security->validatePassword($model->current_password, Yii::$app->user->identity->password)) {
                $model->password = Yii::$app->security->generatePasswordHash($model->new_password);
                if ($model->save()) { //update is successful
                    Yii::$app->session->setFlash('success', 'Password updated');
                    return $this->refresh();
                } else { //update was not successful
                    Yii::$app->session->setFlash('danger', 'Try again');
                }
            } else { //current password not correct
                Yii::$app->session->setFlash('danger', 'Invalid Current Password!');
            }
        }
        return $this->render('password', ['model' => $model]);
    }

    public function actionChangepassword()
    {
        $model = UserModel::findOne(['id' => Yii::$app->user->id]);
        $model->scenario = 'password';
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                Yii::$app->session->setFlash('danger', 'Try again');
                return $this->redirect(Yii::$app->request->referrer);
            }
           
                $model->password = Yii::$app->security->generatePasswordHash($model->new_password);

                //update login_first_time in the database
                $model->login_first_time = 1;

                if ($model->save()) { //update is successful
                    Yii::$app->session->setFlash('success', 'Password updated');
                    return $this->redirect(['/affiliate']);
                } else { //update was not successful
                    Yii::$app->session->setFlash('danger', 'Try again');
                }
           
                Yii::$app->session->setFlash('danger', 'Invalid Current Password!');
           
        }
        return $this->render('changepassword', ['model' => $model]);
    }
}
