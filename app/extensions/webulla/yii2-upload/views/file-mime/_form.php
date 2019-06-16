<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var webulla\upload\models\FileMime $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="file-mime-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'group')->textInput(['maxlength' => 255]) ?>

  <?= $form->field($model, 'type')->textInput(['maxlength' => 255]) ?>

  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
