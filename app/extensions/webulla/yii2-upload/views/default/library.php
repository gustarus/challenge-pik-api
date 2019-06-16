<?php
/**
 * Created by PhpStorm.
 * User: pkondratenko
 * Date: 24.10.15
 * Time: 15:16
 */

/** @var \yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $provider */

webulla\upload\assets\Asset::register($this);

$this->params['header'] = 'Библиотека файлов';
?>

<? echo \webulla\upload\widgets\DropzoneWidget::widget([
  'options' => [
    'class' => 'upload__zone',
  ],
  'clientOptions' => [
    'maxFiles' => 4,
  ],
]) ?>

<br>

<div class="upload__collection">
  <? echo \yii\widgets\ListView::widget([
    'dataProvider' => $provider,
    'itemView' => '_item',
    'layout' => '<div class="clearfix text-right">{summary}</div><div class="row">{items}</div><div class="clearfix text-center">{pager}</div>',
  ]) ?>
</div>

<script type="text/javascript">
    $(function () {
        $('.js-link-copy').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            var $that = $(this);

            // копируем ссылку на файл
            copy($that.attr('href'));

            // уведомляем пользователя
            var label = $that.html();
            $that.html('Ссылка скопирована').addClass('btn-success');
            setTimeout(function () {
                $that.html(label).removeClass('btn-success');
            }, 1000);
        });
    });

    function copy(text) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
