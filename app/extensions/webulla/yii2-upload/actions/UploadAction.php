<?php
/**
 * Created by:  Itella Connexions ©
 * Created at:  13:49 17.04.15
 * Developer:   Pavel Kondratenko
 * Contact:     gustarus@gmail.com
 */

namespace webulla\upload\actions;

use Yii;
use webulla\upload\models\File;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class UploadAction extends Action {

  /**
   * @var string
   */
  public $name = 'file';

  /**
   * @var string
   */
  public $path = '@webroot/uploads/{dir}/{name}';


  /**
   * @inheritdoc
   */
  public function run() {
    if (!Yii::$app->request->isAjax) {
      throw new BadRequestHttpException('Only ajax requests available.');
    }

    if (!$file = UploadedFile::getInstanceByName($this->name)) {
      throw new BadRequestHttpException('File was not found in request.');
    }

    $model = new File();
    if (!$model->upload($file, $this->path)) {
      throw new ServerErrorHttpException('File was not uploaded.');
    }

    \Yii::$app->response->format = Response::FORMAT_JSON;

    return $model;
  }
} 