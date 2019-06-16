<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var webulla\upload\search\FileMimeSearch $searchModel
 */

$this->title = 'File Mimes';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="file-mime-index">
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p class="text-right">
    <?= Html::a('Create File Mime', ['create'], ['class' => 'btn btn-success']) ?>
  </p>

  <?=
  GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
      ['class' => 'yii\grid\SerialColumn'],

      'id',
      'group',
      'type',

      ['class' => 'yii\grid\ActionColumn'],
    ],
  ]); ?>
</div>
