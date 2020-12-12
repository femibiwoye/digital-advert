<?php
/**
 * Created by IntelliJ IDEA.
 * User: femiibiwoye
 * Date: 17/01/2020
 * Time: 12:30
 */

namespace common\components;


use common\models\User;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class ConvertImage extends Widget
{

    public $model;

    public function ImageUpload($folder = null, $isAdmin = false)
    {
        $model = $this->model;

        // try {
        //$data = file_get_contents($this->model->fileImage->tempName);
        $cfile = new \CURLFile(realpath($model->tempName), $model->type, $model->name);

        $response = $this->FileUpload($folder, $cfile, $isAdmin);
        return ArrayHelper::toArray($response)['data'];
//        } catch (\Exception $e) {
//            return $e;
//        }

    }

    public function PlainFileUpload($folder = null)
    {
        $model = $this->model;
        try {
            $cfile = new \CURLFile(realpath($model['tmp_name']), $model['type'], $model['name']);

            $response = $this->FileUpload($folder, $cfile);

            return ArrayHelper::toArray($response)['data'];
        } catch (\Exception $e) {
            return $e;
        }

    }

    private function FileUpload($folder, $cfile, $isAdmin = false)
    {
        $curl = curl_init(Yii::$app->params['S3FileUpload'] . $folder);
        if ($isAdmin) {
            $user = User::findOne(['<>', 'status', 0]);
            $token = 'jksdngflsjdgopskdfoijewofijew9r4jofiewkfljsdopfje09fjwelv0pwjf9jmk454sdg';//!empty($user) ? $user->token : null;
        } else
            $token = Yii::$app->user->identity->token;
        $header = [
            'Authorization: Bearer ' . $token,
            "Content-Type: multipart/form-data"
        ];
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, 1); // Specify the request method as POST
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); // Specify the request method as POST
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, ['file' => $cfile]); // Set the posted fields
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response = json_decode($response);
    }

    public function DeleteImage($image)
    {
        $url = "https://api.morerave.com/v2/aws/delete-file?url=" . $image;
        $curl = curl_init("$url");

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31'
        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . Yii::$app->params['S3Bearer'],
            'Content-Type: application/json',
            "Cache-Control: no-cache",
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        //die;
    }

}