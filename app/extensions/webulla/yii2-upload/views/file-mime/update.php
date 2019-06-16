<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webulla\upload\models\FileMime $model
 */

$this->title = 'Update File Mime: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'File Mimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="file-mime-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <?=
  $this->render('_form', [
    'model' => $model,
  ]) ?>

</div>
