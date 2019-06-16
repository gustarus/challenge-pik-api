<?php
/**
 * Created by:  Itella Connexions ©
 * Created at:  13:49 17.04.15
 * Developer:   Pavel Kondratenko
 * Contact:     gustarus@gmail.com
 */

namespace webulla\upload\actions;

use webulla\upload\models\File;
use yii\base\Action;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class DownloadAction extends Action {

  /**
   * @inheritdoc
   */
  public function run($id) {
    /** @var File $model */
    if (!$model = File::findOne($id)) {
      throw new NotFoundHttpException();
    }

    return \Yii::$app->response->sendFile($model->getAbsoluteSrc(), $model->name);
  }
} 