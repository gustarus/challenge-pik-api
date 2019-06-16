<?php

namespace app\modules\muffin\controllers;

use app\modules\muffin\components\BaseController;
use webulla\upload\actions\DownloadAction;
use webulla\upload\actions\UploadAction;

class PictureController extends BaseController {


  /**
   * @inheritdoc
   */
  public function actions() {
    return [
      'upload' => [
        'class' => UploadAction::className(),
      ],

      'download' => [
        'class' => DownloadAction::className(),
      ],
    ];
  }
}
