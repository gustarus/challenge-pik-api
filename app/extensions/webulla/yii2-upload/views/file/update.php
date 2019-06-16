<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webulla\upload\models\File $model
 */

$this->title = 'Update File: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="file-update">
  <?=
  $this->render('_form', [
    'model' => $model,
  ]) ?>
</div>
