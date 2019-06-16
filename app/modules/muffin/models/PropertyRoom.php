<?php

namespace app\modules\muffin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%property_room}}".
 *
 * @property int $id
 * @property int $property_id
 * @property string $type
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Property $property
 * @property PropertyRoomPicture[] $propertyRoomPictures
 */
class PropertyRoom extends \yii\db\ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return '{{%property_room}}';
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
      [['property_id', 'type', 'title'], 'required'],
      [['property_id'], 'integer'],
      [['type', 'title'], 'string', 'max' => 255],
      [['description'], 'string', 'max' => 45],
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
      'type' => 'Type',
      'title' => 'Title',
      'description' => 'Description',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getProperty() {
    return $this->hasOne(Property::className(), ['id' => 'property_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPropertyRoomPictures() {
    return $this->hasMany(PropertyRoomPicture::className(), ['property_room_id' => 'id']);
  }

  /**
   * @inheritdoc
   */
  public function beforeDelete() {
    if (!parent::beforeDelete()) {
      return false;
    }

    foreach ($this->propertyRoomPictures as $picture) {
      if (!$picture->delete()) {
        return false;
      }
    }

    return true;
  }
}
