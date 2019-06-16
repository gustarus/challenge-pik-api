<?php

$params = require __DIR__ . '/params.php';

$config = [
  'id' => 'basic-console',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],

  'aliases' => [
    '@webroot' => __DIR__ . '/../web',
    '@web' => '/',
  ],

  'controllerNamespace' => 'app\commands',
  'controllerMap' => [
    'migrate' => [
      'class' => 'yii\console\controllers\MigrateController',
      'migrationNamespaces' => [
        'webulla\upload\migrations',
      ],
    ],

    'sync' => 'app\modules\sync\commands\DefaultController',
  ],

  'components' => [
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],

    'log' => [
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
  ],

  'params' => $params,
];

if (YII_ENV_DEV) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
  ];
}

return $config;
