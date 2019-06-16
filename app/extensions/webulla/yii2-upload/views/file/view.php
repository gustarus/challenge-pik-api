<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var webulla\upload\models\File $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="file-view">
  <p>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?=
    Html::a('Delete', ['delete', 'id' => $model->id], [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
      ],
    ]) ?>
  </p>

  <?=
  DetailView::widget([
    'model' => $model,
    'attributes' => [
      'id',
      'name',
      'src:ntext',
      'size',
      'mime_id',
    ],
  ]) ?>

  <small>
    <div class="row col-md-6 col-md-offset-3">
      <div class="col-md-6"><?= $model->getAttributeLabel('created_at') ?>:
        <b><?= Yii::$app->formatter->asDatetime($model->created_at) ?></b></div>
      <div class="col-md-6"><?= $model->getAttributeLabel('updated_at') ?>:
        <b><?= Yii::$app->formatter->asDatetime($model->updated_at) ?></b></div>
    </div>
  </small>
</div>
