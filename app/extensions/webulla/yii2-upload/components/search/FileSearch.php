<?php

namespace webulla\upload\components\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webulla\upload\models\File;
use yii\helpers\VarDumper;

/**
 * FileSearch represents the model behind the search form about `upload\models\File`.
 */
class FileSearch extends File {

  public function rules() {
    return [
      [['size'], 'integer'],
      [['id', 'name', 'src', 'created_at'], 'safe'],
    ];
  }

  public function scenarios() {
    return Model::scenarios();
  }

  public function search($params) {
    $query = File::find();

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    if (!($this->load($params) && $this->validate())) {
      return $dataProvider;
    }

    $query->andFilterWhere([
      'id' => $this->id,
      'size' => $this->size,
      'mime_id' => $this->mime_id,
      'created_at' => $this->created_at,
    ]);

    $query->andFilterWhere(['like', 'name', $this->name])
      ->andFilterWhere(['like', 'src', $this->src]);

    return $dataProvider;
  }
}
