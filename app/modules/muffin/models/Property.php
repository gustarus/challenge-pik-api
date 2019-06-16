<?php

namespace app\modules\muffin\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%property}}".
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string $description
 * @property string $address
 * @property double $square
 * @property double $price
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 *
 * @property PropertyPicture[] $propertyPictures
 * @property PropertyRoom[] $propertyRooms
 */
class Property extends \yii\db\ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return '{{%property}}';
  }

  /**
   * @inheritdoc
   */
  public function behaviors() {
    return [
      [
        'class' => TimestampBehavior::className(),
        'value' => new Expression('NOW()'),
      ],
      [
        'class' => BlameableBehavior::className(),
        'updatedByAttribute' => null,
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      ['type', 'in', 'range' => ['residential', 'commercial']],
      [['type', 'title', 'address', 'square', 'price'], 'required'],
      [['description', 'address'], 'string'],
      [['square', 'price'], 'number'],
      [['created_by'], 'integer'],
      [['type', 'title'], 'string', 'max' => 255],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'type' => 'Type',
      'title' => 'Title',
      'description' => 'Description',
      'address' => 'Address',
      'square' => 'square',
      'price' => 'Price',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
      'created_by' => 'Created By',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPropertyPictures() {
    return $this->hasMany(PropertyPicture::className(), ['property_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPropertyRooms() {
    return $this->hasMany(PropertyRoom::className(), ['property_id' => 'id']);
  }

  /**
   * @inheritdoc
   */
  public function beforeDelete() {
    if (!parent::beforeDelete()) {
      return false;
    }

    // remove pictures
    foreach ($this->propertyPictures as $picture) {
      if (!$picture->delete()) {
        return false;
      }
    }

    // remove rooms
    foreach ($this->propertyRooms as $room) {
      if (!$room->delete()) {
        return false;
      }
    }

    return true;
  }
}
