<?php

namespace app\modules\muffin\controllers;

use app\modules\muffin\components\ActiveController;
use app\modules\muffin\components\SearchAction;
use app\modules\muffin\search\PropertyRoomPicturePlacemarkSearch;

class PropertyRoomPicturePlacemarkController extends ActiveController {

  public $modelClass = 'app\modules\muffin\models\PropertyRoomPicturePlacemark';

  public function actions() {
    return array_merge(parent::actions(), [
      'search' => [
        'class' => SearchAction::className(),
        'searchClass' => PropertyRoomPicturePlacemarkSearch::className(),
        'unlimitedResponse' => true,
      ],
    ]);
  }
}
