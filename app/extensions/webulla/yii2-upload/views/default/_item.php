<?php
/**
 * Created by PhpStorm.
 * User: pkondratenko
 * Date: 24.10.15
 * Time: 15:19
 */

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \yii\web\View $this */
/** @var \webulla\upload\models\File $model */
?>

<div class="col-xs-3 file">
  <? if ($model->mime->group == 'image') { ?>
    <div class="file__content file__content_img" style="background-image: url('<?= $model->getWebSrc() ?>');"></div>
  <? } else { ?>
    <div class="file__content file__content_default">
      <?= $model->mime->group ?>
    </div>
  <? } ?>

  <div class="file__description">
    <p><?= Html::a('Скопировать ссылку на файл', Url::to($model->getWebSrc(), true), ['class' => 'btn btn-xs btn-block btn-default js-link-copy']) ?></p>
  </div>
</div>