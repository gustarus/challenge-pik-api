<?php

namespace app\modules\muffin\models;

use Yii;
use webulla\upload\models\File;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%property_picture}}".
 *
 * @property int $id
 * @property int $property_id
 * @property int $file_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property File $file
 * @property Property $property
 */
class PropertyPicture extends \yii\db\ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return '{{%property_picture}}';
  }

  /**
   * @inheritdoc
   */
  public function behaviors() {
    return [
      [
        'class' => TimestampBehavior::className(),
        'value' => new Expression('NOW()'),
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['property_id', 'file_id'], 'required'],
      [['property_id', 'file_id'], 'integer'],
      [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['file_id' => 'id']],
      [['property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['property_id' => 'id']],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'property_id' => 'Property ID',
      'file_id' => 'File ID',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getFile() {
    return $this->hasOne(File::className(), ['id' => 'file_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getProperty() {
    return $this->hasOne(Property::className(), ['id' => 'property_id']);
  }

  /**
   * @inheritdoc
   */
  public function afterDelete() {
    if (!parent::afterDelete()) {
      return false;
    }

    return $this->file->delete();
  }
}
