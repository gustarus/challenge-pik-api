<?php

namespace app\modules\muffin\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\muffin\models\PropertyRoomPicturePlacemark;

/**
 * PropertyRoomPicturePlacemarkSearch represents the model behind the search form of `app\modules\muffin\models\PropertyRoomPicturePlacemark`.
 */
class PropertyRoomPicturePlacemarkSearch extends PropertyRoomPicturePlacemark
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'property_room_picture_id', 'x', 'y'], 'integer'],
            [['title', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PropertyRoomPicturePlacemark::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'property_room_picture_id' => $this->property_room_picture_id,
            'x' => $this->x,
            'y' => $this->y,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
