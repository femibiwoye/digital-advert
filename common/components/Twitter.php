<?php

namespace common\components;

use Abraham\TwitterOAuth\TwitterOAuth;
use common\models\Posts;
use Yii;
use yii\base\Model;
use yii\helpers\Url;


class Twitter extends Model
{

    public static function TwitterConnection()
    {
        return new TwitterOAuth(Yii::$app->params['TwitterConsumerKey'], Yii::$app->params['TwitterConsumerSecret'], Yii::$app->params['TwitterAccessToken'], Yii::$app->params['TwitterAccessTokenSecret']);
    }

    public static function TweetPost($post_id)
    {
        $path = Url::to("@webfolder/images/tmp/");
        Utilities::CreateFolder($path);
        $post = Posts::findOne(['id' => $post_id, 'is_posted_to_twitter'=>0]);
        if(!$post){
            return false;
        }
        $connection = self::TwitterConnection();
        $data = array("status" => $post->content);
        $media = $post->media;

        if (!empty($media) && $media != "[]") {

            if (is_array($media)) {
                $upload = [];
                foreach ($media as $m) {
                    $uploadResponse = $connection->upload('media/upload', ['media' => self::GetFileNameWithExtension($m,$path)]);
                    $upload[] = $uploadResponse->media_id_string;
                }
                $data['media_ids'] = implode(',', $upload);
            } else {
                $upload = $connection->upload('media/upload', ['media' => self::GetFileNameWithExtension($media,$path)]);
                $data["media_ids"] = $upload->media_id_string;
            }
        }

        $statusUpdate = $connection->post("statuses/update", $data);
        $post->tweet_id = $statusUpdate->id_str;
        $post->raw = json_encode($statusUpdate);
        $post->is_posted_to_twitter = 1;
        $post->is_approved = 1;
        $post->is_promoted = 1;
        if ($post->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function GetFileNameWithExtension($file,$path)
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
}