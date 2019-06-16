<?php

namespace app\modules\muffin\controllers;

use app\modules\muffin\components\ActiveController;
use app\modules\muffin\components\SearchAction;
use app\modules\muffin\search\PropertySearch;

class PropertyController extends ActiveController {

  public $modelClass = 'app\modules\muffin\models\Property';

  public function actions() {
    return array_merge(parent::actions(), [
      'search' => [
        'class' => SearchAction::className(),
        'searchClass' => PropertySearch::className(),
        'unlimitedResponse' => true,
      ],
    ]);
  }
}
