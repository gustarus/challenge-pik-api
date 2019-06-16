<?php
/**
 * Created by:  Itella Connexions ©
 * Created at:  15:45 24.04.14
 * Developer:   Pavel Kondratenko
 * Contact:     gustarus@gmail.com
 */

namespace webulla\upload\widgets;

use webulla\upload\models\File;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;

class DropzoneWidget extends \webulla\dropzone\DropzoneWidget {

  /**
   * @var Model
   */
  public $model;

  /**
   * @var string
   */
  public $attribute;

  /**
   * @inheritdoc
   */
  public function init() {
    parent::init();

    $this->clientOptions['url'] = Url::toRoute('/upload/file/upload');
  }

  /**
   * @inheritdoc
   */
  public function getAdditionalScript() {
    $source = parent::getAdditionalScript();

    if ($this->model && $this->attribute) {
      // скрипт добавления поля с id файла в форму после его загрузки
      $source .= 'zone.on("success", function(file, attributes) {
			$(file.previewElement).append(\'<input type="hidden" name="' . Html::getInputName($this->model, $this->attribute) . ($this->clientOptions['maxFiles'] == 1 ? '' : '[]') . '" value="\' + attributes.id + \'">\');
		});';

      // добавляем все файлы из коллекции
      if ($file_id = $this->model->{$this->attribute}) {
        foreach (File::findAll($file_id) as $file) {
          $source .= '(function() {
					var file = {
						name: ' . json_encode($file->name) . ',
						size: ' . json_encode($file->size) . ',
						src: ' . json_encode($file->getWebSrc()) . '
					};

					// вызываем события
					zone.options.addedfile.call(zone, file);
					zone.options.thumbnail.call(zone, file, file.src);

					// добавляем в коллекцию
					file.accepted = true;
					zone.files.push(file);

					// вызываем событие успешной загрузки файла
					zone.emit("success", file, ' . json_encode($file->attributes) . ');
				})();';
        }
      }
    }

    return $source;
  }
}