<?php
/**
 * Created by PhpStorm.
 * User: supreme
 * Date: 11.05.14
 * Time: 4:20
 */

namespace app\components\grid;

use yii\grid\DataColumn as BaseDataColumn;

class DataColumn extends BaseDataColumn {

  /**
   * @inheritdoc
   */
  public $headerOptions = ['class' => 'text-center'];
} 