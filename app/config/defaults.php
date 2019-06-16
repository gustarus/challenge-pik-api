<?php
$defaults = [
  'basePath' => dirname(__DIR__),
  'timeZone' => 'UTC',

  'aliases' => [
    '@webulla/activerecord' => '@app/extensions/webulla/yii2-activerecord',
    '@webulla/upload' => '@app/extensions/webulla/yii2-upload',
    '@uploads' => '@app/web/uploads',
  ],

  'components' => [
    'db' => [
      'class' => 'yii\db\Connection',
      'dsn' => 'mysql:host=' . $_ENV['MYSQL_HOST'] . ';dbname=' . $_ENV['MYSQL_DATABASE'],
      'username' => $_ENV['MYSQL_ROOT_USER'],
      'password' => $_ENV['MYSQL_ROOT_PASSWORD'],
      'charset' => $_ENV['MYSQL_CHARSET'],
      'tablePrefix' => '',
      'enableSchemaCache' => true,
      'enableQueryCache' => true,
    ],

    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],

    'user' => [
      'class' => 'yii\web\User',
      'identityClass' => 'app\models\User',
      'loginUrl' => ['/user/security/login'],
      'enableAutoLogin' => true,
    ],
  ],

  'modules' => [
    'upload' => [
      'class' => 'webulla\upload\Module',
      'layout' => '@app/modules/manage/views/layouts/main',
    ],

    'user' => [
      'class' => 'dektrium\user\Module',
      'admins' => ['admin'],
      'enableRegistration' => true,
      'enableGeneratingPassword' => false,
      'enableConfirmation' => false,
      'enableUnconfirmedLogin' => true,
      'enablePasswordRecovery' => true,
      'enableFlashMessages' => false,
    ],

    'sync' => [
      'class' => 'app\modules\sync\Module',
    ],
  ],
];

// настройки локальной машины
$path_local = __DIR__ . '/defaults.local.php';
if (file_exists($path_local)) {
  $defaults = \yii\helpers\ArrayHelper::merge($defaults, require $path_local);
}

return $defaults;
