<?php

namespace webulla\upload\models;

use Yii;

/**
 * This is the model class for table "file_mime".
 *
 * @property string $id
 * @property string $group
 * @property string $type
 *
 * @property File[] $files
 */
class FileMime extends \yii\db\ActiveRecord {

  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'file_mime';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['group', 'type'], 'required'],
      [['group', 'type'], 'string', 'max' => 255]
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'group' => 'Group',
      'type' => 'Type',
    ];
  }

  /**
   * @return string
   */
  public function getFull() {
    return $this->group . '/' . $this->type;
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getFiles() {
    return $this->hasMany(File::className(), ['mime_id' => 'id']);
  }
}
