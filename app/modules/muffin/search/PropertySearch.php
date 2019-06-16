<?php

namespace app\modules\muffin\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\muffin\models\Property;

/**
 * PropertySearch represents the model behind the search form of `app\modules\muffin\models\Property`.
 */
class PropertySearch extends Property {

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['id', 'created_by'], 'integer'],
      [['type', 'title', 'description', 'address', 'created_at', 'updated_at'], 'safe'],
      [['square', 'price'], 'number'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function scenarios() {
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
  public function search($params) {
    $query = Property::find();

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
      'square' => $this->square,
      'price' => $this->price,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'created_by' => $this->created_by,
    ]);

    $query->andFilterWhere(['like', 'type', $this->type])
      ->andFilterWhere(['like', 'title', $this->title])
      ->andFilterWhere(['like', 'description', $this->description])
      ->andFilterWhere(['like', 'address', $this->address]);

    return $dataProvider;
  }
}
