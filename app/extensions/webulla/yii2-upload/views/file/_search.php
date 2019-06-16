<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var webulla\upload\search\FileSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="file-search">
  <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
  ]); ?>

  <?= $form->field($model, 'id') ?>
  <?= $form->field($model, 'name') ?>
  <?= $form->field($model, 'src') ?>
  <?= $form->field($model, 'size') ?>
  <?= $form->field($model, 'mime_id') ?>

  <?php // echo $form->field($model, 'created_at') ?>

  <div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>
