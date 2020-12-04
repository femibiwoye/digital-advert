<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * Site controller
 */
class AffiliatesController extends Controller
{

   public function actionIndex()
   {
       return $this->render('index');
   }
}
