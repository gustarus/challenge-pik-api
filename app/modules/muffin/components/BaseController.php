<?php

namespace app\modules\muffin\components;

use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

class BaseController extends Controller {

  /**
   * @inheritdoc
   */
  public function behaviors() {
    $behaviors = parent::behaviors();
    $behaviors['authenticator'] = [
      'class' => HttpBearerAuth::className(),
    ];

    return $behaviors;
  }
}
