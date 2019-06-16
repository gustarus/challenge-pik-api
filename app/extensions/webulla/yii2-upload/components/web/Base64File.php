<?php
/**
 * Created by:  Itella Connexions ©
 * Created at:  16:42 14.04.15
 * Developer:   Pavel Kondratenko
 * Contact:     gustarus@gmail.com
 */

namespace webulla\upload\components\web;

use yii\base\Object;

class Base64File extends Object {

  /**
   * @var string
   */
  public $name;

  /**
   * @var string
   */
  public $data;

  /**
   * @var string
   */
  public $type;


  /**
   * @param string
   * @return bool
   */
  public function saveAs($path) {
    return file_put_contents($path, base64_decode($this->data));
  }

  /**
   * @return string original file base name
   */
  public function getBaseName() {
    return pathinfo($this->name, PATHINFO_FILENAME);
  }

  /**
   * @return string file extension
   */
  public function getExtension() {
    return strtolower(pathinfo($this->name, PATHINFO_EXTENSION));
  }

  /**
   * @return int
   */
  public function getSize() {
    return strlen($this->data);
  }

  /**
   * @param string $data
   * @return Base64File
   */
  public static function parse($data) {
    // проверяем наличие типа в данных
    if (strpos($data, ';')) {
      list($type, $data) = explode(';', $data);
    }

    // проверяем наличие base64 в данных
    if (strpos($data, ',')) {
      list($format, $data) = explode(',', $data);
    }

    $file = new self;
    $file->data = $data;

    return $file;
  }
}