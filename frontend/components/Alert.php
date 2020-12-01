<?php

namespace frontend\components;

use yii\base\Widget;

class Alert extends Widget
{
    public function run()
    {

        foreach (\Yii::$app->session->getAllFlashes() as $key => $message):;

            $icons = ['success' => 'ok-sign', 'info' => 'info-sign', 'warning' => 'exclamation-sign', 'danger' => 'remove-sign', 'growl' => 'asterisk'];
            $icon = isset($icons[$key]) ? $icons[$key] : 'pushpin';
            echo \kartik\growl\Growl::widget([
                'type' => (!empty($key)) ? $key : 'growl',
                'icon' => 'glyphicon glyphicon-' . $icon,
                'body' => $message,
                'showSeparator' => true,
                'delay' => 1, //This delay is how long before the message shows
                'pluginOptions' => [
                    'delay' => 10000, //This delay is how long the message shows for
                    'showProgressbar' => true,
                    'placement' => [
                        'from' => 'top',
                        'align' => 'right',
                    ]
                ]
            ]);
        endforeach;

    }
}