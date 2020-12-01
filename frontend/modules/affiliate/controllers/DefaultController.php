<?php

namespace frontend\modules\affiliate\controllers;

use yii\web\Controller;

/**
 * Default controller for the `affiliate` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //echo 'i am '.\Yii::$app->user->isGuest;
        return $this->render('index');
    }
}
