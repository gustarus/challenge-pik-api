<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webulla\upload\models\FileMime $model
 */

$this->title = 'Create File Mime';
$this->params['breadcrumbs'][] = ['label' => 'File Mimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-mime-create">

  <h1><?= Html::encode($this->title) ?></h1>

  <?=
  $this->render('_form', [
    'model' => $model,
  ]) ?>

</div>
