<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var webulla\upload\search\FileSearch $searchModel
 */

$this->title = 'Files';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="file-index">
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p class="text-right">
    <?= Html::a('Create File', ['create'], ['class' => 'btn btn-success']) ?>
  </p>

  <?=
  GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
      'name',
      'src:ntext',
      'size:size',
      [
        'value' => 'mime.full',
        'format' => 'raw',
        'header' => $searchModel->getAttributeLabel('mime_id'),
      ],
    ],
  ]); ?>
</div>
