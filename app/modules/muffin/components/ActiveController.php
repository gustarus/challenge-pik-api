<?php

namespace app\modules\muffin\components;

use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController as BaseController;

class ActiveController extends BaseController {

  public $defaultPageSize = 20;

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

  /**
   * @inheritdoc
   */
  public function actions() {
    return [
      'index' => [
        'class' => 'yii\rest\IndexAction',
        'modelClass' => $this->modelClass,
        'checkAccess' => [$this, 'checkAccess'],
        'prepareDataProvider' => [$this, 'prepareDataProvider'],
      ],

      'view' => [
        'class' => 'yii\rest\ViewAction',
        'modelClass' => $this->modelClass,
        'checkAccess' => [$this, 'checkAccess'],
      ],

      'options' => [
        'class' => 'yii\rest\OptionsAction',
      ],
    ];
  }

  /**
   * @param $action
   * @param $filter
   * @return object
   * @throws \yii\base\InvalidConfigException
   */
  public function prepareDataProvider($action, $filter) {
    /** @var ActiveRecord $modelClass */
    $modelClass = $this->modelClass;

    $query = $modelClass::find();
    if (!empty($filter)) {
      $query->andWhere($filter);
    }

    return Yii::createObject([
      'class' => ActiveDataProvider::className(),
      'query' => $query,
      'pagination' => [
        'defaultPageSize' => $this->defaultPageSize,
      ]
    ]);
  }
}
