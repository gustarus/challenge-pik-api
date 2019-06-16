<?php

namespace app\modules\muffin;

use Yii;

class Module extends \yii\base\Module {

  /**
   * @inheritdoc
   */
  public function init() {
    parent::init();
    Yii::$app->urlManager->enableStrictParsing = true;
    Yii::$app->user->enableSession = false;
    Yii::$app->user->loginUrl = null;
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    Yii::$app->errorHandler->errorAction = 'rest/service/error';

    if (YII_ENV === YII_ENV_DEV) {
      Yii::$app->response->headers->set('Access-Control-Allow-Origin', '*');
    }
  }
}
