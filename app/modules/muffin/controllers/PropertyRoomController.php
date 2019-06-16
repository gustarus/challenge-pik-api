<?php

namespace app\modules\muffin\controllers;

use app\modules\muffin\components\ActiveController;
use app\modules\muffin\components\SearchAction;
use app\modules\muffin\search\PropertyRoomSearch;

class PropertyRoomController extends ActiveController {

  public $modelClass = 'app\modules\muffin\models\PropertyRoom';

  public function actions() {
    return array_merge(parent::actions(), [
      'search' => [
        'class' => SearchAction::className(),
        'searchClass' => PropertyRoomSearch::className(),
        'unlimitedResponse' => true,
      ],
    ]);
  }
}
