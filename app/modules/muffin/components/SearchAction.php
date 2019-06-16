<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\muffin\components;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecordInterface;
use yii\web\NotFoundHttpException;

class SearchAction extends \yii\base\Action {

  public $searchClass;

  public $unlimitedResponse = false;

  public $ulimitedSafeThreshold = 3333;

  public function init() {
    if ($this->searchClass === null) {
      throw new InvalidConfigException(get_class($this) . '::$searchClass must be set.');
    }
  }

  public function run() {
    return $this->prepareDataProvider();
  }

  protected function prepareDataProvider() {
    $searchModel = new $this->searchClass;

    $key = $searchModel->formName();
    $value = Yii::$app->request->queryParams;
    $provider = $searchModel->search([$key => $value]);
    if ($this->unlimitedResponse) {
      $provider->pagination->pageSize = $this->ulimitedSafeThreshold;
    }

    return ArrayHelper::index($provider->models, 'id');
  }
}
