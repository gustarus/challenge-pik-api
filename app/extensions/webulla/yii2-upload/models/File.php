<?php

namespace webulla\upload\models;

use webulla\upload\components\web\Base64File;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "file".
 *
 * @property string $id
 * @property string $name
 * @property string $src
 * @property integer $size
 * @property string $mime_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FileMime $mime
 */
class File extends \yii\db\ActiveRecord {

  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'file';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['name', 'src', 'size', 'mime_id'], 'required'],
      [['src'], 'string'],
      [['size', 'mime_id'], 'integer'],
      [['name'], 'string', 'max' => 255],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'name' => 'Name',
      'src' => 'Src',
      'size' => 'Size',
      'mime_id' => 'Mime ID',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  /**
   * @inheritdoc
   */
  public function behaviors() {
    return [
      ['class' => TimestampBehavior::className(), 'value' => new Expression('NOW()')],
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getMime() {
    return $this->hasOne(FileMime::className(), ['id' => 'mime_id']);
  }

  /**
   * @return string
   */
  public function getStaticSrc() {
    return str_replace('@', '/', $this->src);
  }

  /**
   * @return string
   */
  public function getAbsoluteSrc() {
    return Yii::getAlias($this->src);
  }

  /**
   * @return mixed
   */
  public function getWebSrc() {
    return str_replace('@webroot', Yii::$app->urlManager->getBaseUrl(), $this->src);
  }

  /**
   * @inheritdoc
   */
  public function afterFind() {
    parent::afterFind();
  }

  /**
   * @inheritdoc
   */
  public function beforeDelete() {
    if (!parent::beforeDelete()) {
      return false;
    }

    // удаляем файл из файловой системы
    $src = Yii::getAlias($this->src);
    if (file_exists($src)) {
      if (!unlink($src)) {
        return false;
      }
    }

    return true;
  }


  /**
   * Загружает файл.
   * @param $src
   * @return bool
   */
  /**
   * @param UploadedFile|Base64File $file
   * @param string $path
   * @return bool
   */
  public function upload($file, $path) {
    if ($file) {
      if (!$this->name) {
        $this->name = $file->name;
      }

      if (!$this->size) {
        $this->size = $file->size;
      }

      if ($this->validate(['name', 'size'])) {
        // собираем директорию
        $dirAlias = dirname($path);
        $dirGenerated = 'c/' . $this->generateDirByDate();
        $dir = Yii::getAlias(str_replace('{dir}', $dirGenerated, $dirAlias));

        // собираем имя файла
        $nameAlias = basename($path);
        $nameGenerated = $this->generateNameByDate() . '.' . $file->getExtension();
        $name = str_replace('{name}', $nameGenerated, $nameAlias);

        // заменяем шаблоны в атрибуте
        $this->src = str_replace(['{dir}', '{name}'], [$dirGenerated, $nameGenerated], $path);

        // проверяем наличие директории
        if (!is_dir($dir)) {
          FileHelper::createDirectory($dir);
        }

        // сохраняем файл
        if (!$file->saveAs($dir . '/' . $name)) {
          return false;
        }

        // разбиваем тип на части
        $mime_data = explode('/', $file->type);

        // пытаемся найти модель типа
        $mime = FileMime::find()
          ->where(['group' => $mime_data[0], 'type' => $mime_data[1]])
          ->one();

        // создаем модель типа, если не найдена
        if (!$mime) {
          $mime = new FileMime();
          $mime->group = $mime_data[0];
          $mime->type = $mime_data[1];

          if ($mime->save()) {
            $this->mime_id = $mime->id;
          }
        } else {
          $this->mime_id = $mime->id;
        }

        return $this->save();
      }
    }

    return false;
  }

  /**
   * Получает название директории основываясь на текущей дате.
   * @return bool|string
   */
  public function generateDirByDate() {
    return date('y/n');
  }

  /**
   * Получает название файла основываясь на дате.
   * @return bool|string
   */
  public function generateNameByDate() {
    return date('j.H.i.s.') . (microtime(true) * 10000 % 10000);
  }
}
