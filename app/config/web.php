<?php

$params = require __DIR__ . '/params.php';

$config = [
  'id' => 'basic',
  'name' => 'tripstips',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'defaultRoute' => 'manage',

  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
  ],

  'components' => [
    'request' => [
      'cookieValidationKey' => 'DAS*&yd7827y7d8qATD&^T3ud7i6',
      'parsers' => [
        'application/json' => 'yii\web\JsonParser',
      ],
    ],

    'user' => [
      'class' => 'yii\web\User',
      'identityClass' => 'app\models\User',
      'loginUrl' => ['/user/security/login'],
      'enableAutoLogin' => true,
    ],

    'errorHandler' => [
      'errorAction' => 'default/error',
    ],

    'mailer' => [
      'class' => 'yii\swiftmailer\Mailer',
      // send all mails to a file by default. You have to set
      // 'useFileTransport' to false and configure a transport
      // for the mailer to send real emails.
      'useFileTransport' => true,
    ],

    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],

    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
        [
          'class' => 'yii\rest\UrlRule',
          'pluralize' => false,
          'controller' => [
             'muffin/property',
             'muffin/property-room',
             'muffin/property-picture',
             'muffin/property-room-picture',
          ]
        ],

        '/muffin/auth/login' => '/muffin/auth/login',
        '/muffin/auth/logout' => '/muffin/auth/logout',
        '/muffin/service/hello' => '/muffin/service/hello',
        '/muffin/file/upload' => '/muffin/file/upload',
        '/muffin/file/download' => '/muffin/file/download',
      ],
    ],

    'view' => [
      'class' => 'app\components\web\View',
    ],
  ],

  'modules' => [
    'muffin' => [
      'class' => 'app\modules\muffin\Module',
    ],
  ],

  'params' => $params,
];

if (YII_ENV_DEV) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
    'allowedIPs' => ['*'],
    // uncomment the following to add your IP if you are not connecting from localhost.
    // 'allowedIPs' => ['127.0.0.1', '::1', 'localhost'],
  ];

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    'allowedIPs' => ['*'],
    // uncomment the following to add your IP if you are not connecting from localhost.
    // 'allowedIPs' => ['127.0.0.1', '::1', 'localhost'],
  ];
}

return $config;
