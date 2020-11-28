<?php
/**
 * Created by IntelliJ IDEA.
 * User: femiibiwoye
 * Date: 01/05/2020
 * Time: 22:39
 */


namespace frontend\components;


use frontend\models\WebsiteError;
use yii\base\Widget;
use Yii;

class LogError extends Widget
{
    public $name;

    public function run()
    {

        if (!isset(Yii::$app->request->referrer)) {
            $prev = 'Coming from no where';
        } else {
            $prev = Yii::$app->request->referrer;
        }
        if (Yii::$app->user->isGuest) {
            $user = 'Visitor';
        } else {
            $user = Yii::$app->user->id;
        }
        $currentUrl = Yii::$app->request->absoluteUrl;
        if (!WebsiteError::find()->where(['error' => $this->name, 'current' => $currentUrl, 'user'=>$user])->exists()) {
            $err = new WebsiteError();
            $err->error = $this->name;
            $err->user = $user;
            $err->current = $currentUrl;
            $err->previous = $prev;
            $err->save();
        }
    }
}