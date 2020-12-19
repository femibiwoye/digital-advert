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

    public static function TwitterConnection($twitterAccessToken = null, $twitterAccessTokenSecret = null)
    {
        if (empty($twitterAccessToken) || empty($twitterAccessTokenSecret)) {
            $twitterAccessToken = Yii::$app->params['TwitterAccessToken'];
            $twitterAccessTokenSecret = Yii::$app->params['TwitterAccessTokenSecret'];
        }
        return new TwitterOAuth(Yii::$app->params['TwitterConsumerKey'], Yii::$app->params['TwitterConsumerSecret'], $twitterAccessToken, $twitterAccessTokenSecret);
    }

    public static function GetFileNameWithExtension($file, $path)
    {
        if (empty(pathinfo($file, PATHINFO_EXTENSION)) || !filter_var($file, FILTER_VALIDATE_URL)) {
            return false;
        }

        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        $name = "$path/$fileName.$fileExt";
        file_put_contents($name, file_get_contents($file));
        return $name;
    }

    public static function CreateFolder($folder)
    {
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        return true;
    }
}