<?php
/**
 * Created by:  Itella Connexions ©
 * Created at:  16:42 14.04.15
 * Developer:   Pavel Kondratenko
 * Contact:     gustarus@gmail.com
 */

namespace webulla\upload\components\web;

use yii\base\Object;

class UrlFile extends Object {

  /**
   * @var string
   */
  public $url;

  /**
   * @var string
   */
  public $name;

  /**
   * @var string
   */
  public $type;


  /**
   * @param string
   * @return bool
   */
  public function saveAs($path) {
    $content = @file_get_contents($this->url);
    if (!$content) {
      return false;
    }

    return file_put_contents($path, $content);
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
    return 0;
  }

  /**
   * @param string $url
   * @return self
   */
  public static function parse($url) {
    $file = new self;
    $file->url = $url;

    return $file;
  }
}