<?php
/**
 * Created by:  Pavel Kondratenko
 * Created at:  18:16 04.04.14
 * Contact:     gustarus@gmail.com
 */

namespace app\components\web;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use \yii\web\Controller as WebController;

class Controller extends WebController {

  /**
   * @inheritdoc
   */
  public function behaviors() {
    $behaviours = [];

    // default verb filter for crud actions
    $behaviours['verbs'] = [
      'class' => VerbFilter::className(),
      'actions' => [
        'index' => ['get'],
        'view' => ['get'],
        'create' => ['get', 'post'],
        'update' => ['get', 'put', 'post'],
        'delete' => ['post', 'delete'],
      ],
    ];

    // default access filter
    if ($rules = $this->getRules()) {
      $behaviours['access'] = [
        'class' => AccessControl::className(),
        'rules' => $rules,
      ];
    }

    return $behaviours;
  }

  /**
   * @return array
   */
  public function getRules() {
    return [];
  }
}
