<?php

namespace webulla\upload\components\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webulla\upload\models\FileMime;

/**
 * FileMimeSearch represents the model behind the search form about `upload\models\FileMime`.
 */
class FileMimeSearch extends FileMime {

  public function rules() {
    return [
      [['id', 'group', 'type'], 'safe'],
    ];
  }

  public function scenarios() {
    return Model::scenarios();
  }

  public function search($params) {
    $query = FileMime::find();

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    if (!($this->load($params) && $this->validate())) {
      return $dataProvider;
    }

    $query->andFilterWhere([
      'id' => $this->id,
    ]);

    $query->andFilterWhere(['like', 'group', $this->group])
      ->andFilterWhere(['like', 'type', $this->type]);

    return $dataProvider;
  }
}
