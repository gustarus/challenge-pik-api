<?php

namespace app\modules\muffin\controllers;

use app\modules\muffin\components\ActiveController;
use app\modules\muffin\components\SearchAction;
use app\modules\muffin\search\PropertyPictureSearch;

class PropertyPictureController extends ActiveController {

  public $modelClass = 'app\modules\muffin\models\PropertyPicture';

  public function actions() {
    return array_merge(parent::actions(), [
      'search' => [
        'class' => SearchAction::className(),
        'searchClass' => PropertyPictureSearch::className(),
        'unlimitedResponse' => true,
      ],
    ]);
  }
}
