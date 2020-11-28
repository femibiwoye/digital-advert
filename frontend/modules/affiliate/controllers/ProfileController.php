<?php

namespace frontend\modules\affiliate\controllers;

use common\components\ConvertImage;
use common\models\User;
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
        if ($model->load(Yii::$app->request->post())) {

            $model->image_path = UploadedFile::getInstance($model, 'image_path');

            if ($model->image_path) {
                $s3 = new ConvertImage(['model' => $model->image_path]);
                $imageResponse = $s3->ImageUpload('users');
                if (isset($imageResponse['ObjectURL']) && !empty($imageResponse['ObjectURL'])) {
                    $model->image_path = $imageResponse['ObjectURL'];
                }
            }

            $model->updated();
        }

        return $this->render('index', ['model' => $model]);
    }
}
