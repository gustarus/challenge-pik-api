<?php
/**
 * Created by:  Itella Connexions ©
 * Created at:  18:16 04.03.15
 * Developer:   Pavel Kondratenko
 * Contact:     gustarus@gmail.com
 */

namespace app\components\web;

class View extends \yii\web\View {

  /**
   * @var string
   */
  public $header;

  /**
   * @var string
   */
  public $title;

  /**
   * @var string
   */
  public $description;

  /**
   * @var string
   */
  public $keywords;

  /**
   * @var array
   */
  public $breadcrumbs = [];

  /**
   * @return string
   */
  public function getFilledTitle() {
    return ($this->title ? $this->title : strip_tags($this->header)) ?: \Yii::t('app', 'Power sockets types in the world');
  }
}