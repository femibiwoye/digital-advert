<?php

namespace api\components;

use Abraham\TwitterOAuth\TwitterOAuth;
use Yii;
use yii\base\Model;


class Utility extends Model
{

    public static function FormatBytesSize($bytes, $precision = 2)
    {
        $units = array('b', 'kb', 'mb', 'gb', 'tb');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . $units[$pow];
    }

    public static function TwitterConnection()
    {
        return new TwitterOAuth(Yii::$app->params['TwitterConsumerKey'], Yii::$app->params['TwitterConsumerSecret'], Yii::$app->params['TwitterAccessToken'],Yii::$app->params['TwitterAccessTokenSecret']);
    }
}