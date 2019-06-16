<?php

namespace app\modules\muffin\controllers;

use app\modules\muffin\components\ActiveController;
use app\modules\muffin\components\SearchAction;
use app\modules\muffin\search\PropertyRoomPictureSearch;

class PropertyRoomPictureController extends ActiveController {

  public $modelClass = 'app\modules\muffin\models\PropertyRoomPicture';

  public function actions() {
    return array_merge(parent::actions(), [
      'search' => [
        'class' => SearchAction::className(),
        'searchClass' => PropertyRoomPictureSearch::className(),
        'unlimitedResponse' => true,
      ],
    ]);
  }
}
