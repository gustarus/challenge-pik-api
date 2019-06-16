<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var webulla\upload\models\File $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="file-form">
  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'src')->textInput(['maxlength' => 255]) ?>
  <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
  <?= $form->field($model, 'src')->textarea(['rows' => 6]) ?>
  <?= $form->field($model, 'size')->textInput() ?>
  <?= $form->field($model, 'mime_id')->textInput(['maxlength' => 10]) ?>

  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>
