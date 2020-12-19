<?php

namespace common\components;

use yii\base\Model;


class Utilities extends Model
{
    /**
     * This function allows you to create a folder with the necessary permission if it doesn't exist.
     * @param $folder
     * @return bool
     */
    public static function CreateFolder($folder)
    {
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        return true;
    }
}