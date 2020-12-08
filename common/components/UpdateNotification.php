<?php

namespace common\components;

use common\models\Notification;
use yii\base\Widget;

class UpdateNotification extends Widget
{
    public $content;
    public $title;
    public $user_id = null;
    public $generality;

    public function run()
    {
        $model = new Notification();
        $model->title = $this->title;
        $model->description = $this->content;
        $model->admin_id = \Yii::$app->user->id;
        $model->generality = $this->generality;
        if($this->generality == 'user'){
            $model->user_id = $this->user_id;
        }
        return $model->save();
    }
}