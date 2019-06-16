<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<div class="site-index">
  <div class="jumbotron">
    <h1>Welcome!</h1>
    <p class="lead">Manage the api via this tool.</p>
    <p><?= Html::a('Let\'s start manage &raquo;', ['/manage'], ['class' => 'btn btn-lg btn-success']) ?></p>
  </div>
</div>
