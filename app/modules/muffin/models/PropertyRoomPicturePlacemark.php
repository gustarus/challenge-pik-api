<?php

namespace app\modules\muffin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "property_room_picture_placemark".
 *
 * @property int $id
 * @property int $property_room_picture_id
 * @property string $title
 * @property int $x
 * @property int $y
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PropertyRoomPicture $propertyRoomPicture
 */
class PropertyRoomPicturePlacemark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property_room_picture_placemark';
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
    public function rules()
    {
        return [
            [['property_room_picture_id', 'title', 'x', 'y'], 'required'],
            [['property_room_picture_id', 'x', 'y'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['property_room_picture_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertyRoomPicture::className(), 'targetAttribute' => ['property_room_picture_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'property_room_picture_id' => 'Property Room Picture ID',
            'title' => 'Title',
            'x' => 'X',
            'y' => 'Y',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyRoomPicture()
    {
        return $this->hasOne(PropertyRoomPicture::className(), ['id' => 'property_room_picture_id']);
    }
}
