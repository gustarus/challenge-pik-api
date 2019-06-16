<?php

namespace app\components\grid;

class SortableGridView extends \richardfan\sortable\SortableGridView {

  /**
   * @inheritdoc
   */
  public $dataColumnClass = 'app\components\grid\DataColumn';

  /**
   * @inheritdoc
   */
  public $tableOptions = ['class' => 'table table-striped'];

  /**
   * @inheritdoc
   */
  public $pager = ['options' => ['class' => 'pagination pagination-sm']];

  /**
   * @inheritdoc
   */
  public $layout = '
		<div class="text-right">{summary}</div>
		{items}
		<div class="text-center">{pager}</div>';

  /**
   * Необходимо ли отображать номер строчки.
   * @var bool
   */
  public $enableSerial = true;

  /**
   * Необходимо ли отображать кнопки управления.
   * @var bool
   */
  public $enableControl = false;

  /**
   * Оборачивать ли таблицу в контейнер.
   * @var bool
   */
  public $enableWrapper = true;


  /**
   * @inheritdoc
   */
  protected function initColumns() {
    // добавляем колонку с номером
    if ($this->enableSerial) {
      array_unshift($this->columns, [
        'attribute' => 'id',
        'label' => '#',
        'headerOptions' => ['class' => 'text-left', 'style' => 'width: 80px;'],
        'contentOptions' => ['class' => 'text-left'],
      ]);
    }

    // добавляем колонку с кнопками управления
    if ($this->enableControl) {
      array_push($this->columns, [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
        'headerOptions' => ['style' => 'width: 80px;'],
        'contentOptions' => ['class' => 'text-center'],
      ]);
    }

    parent::initColumns();
  }
} 