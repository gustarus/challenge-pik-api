<?php
/**
 * Created by:  Itella Connexions ©
 * Created at:  18:42 14.04.15
 * Developer:   Pavel Kondratenko
 * Contact:     gustarus@gmail.com
 */

namespace webulla\upload\components\helpers;

use webulla\upload\components\web\UrlFile;
use Yii;
use webulla\upload\components\web\Base64File;
use webulla\upload\models\File;
use webulla\upload\components\UploadResult;
use yii\web\UploadedFile;

class FileHelper extends \yii\helpers\FileHelper {

  /**
   * @param $data
   * @param $src
   * @param $name
   * @param $type
   * @return bool|File
   */
  public static function uploadBase64File($data, $src, $name = null, $type = null) {
    $file = Base64File::parse($data);
    return self::execute($file, $src, $name, $type);
  }

  /**
   * @param $url
   * @param $src
   * @param $name
   * @param $type
   * @return bool|File
   */
  public static function uploadFromUrl($url, $src, $name, $type = null) {
    $file = UrlFile::parse($url);
    return self::execute($file, $src, $name, $type);
  }

  protected static function execute($file, $src, $name, $type) {
    $name && ($file->name = $name);
    $type && ($file->type = $type);

    $model = new File();
    $result = new UploadResult;
    $result->model = $model;
    if ($model->upload($file, $src)) {
      $result->success = true;
    } else {
      $result->success = false;
    }

    return $result;
  }
}