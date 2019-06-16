<?php

namespace app\modules\muffin\controllers;

use app\models\User;
use app\modules\muffin\components\BaseController;
use dektrium\user\helpers\Password;

class AuthController extends BaseController {

  /**
   * @return string
   * @throws \Exception
   */
  public function actionLogin() {
    $username = \Yii::$app->request->post('username');
    $password = \Yii::$app->request->post('password');

    $user = User::findByUsername($username);
    if (!$username || !$password || !$user) {
      throw new \Exception('Invalid data passed.');
    } else if ($user->validatePassword($password)) {
      if (\Yii::$app->user->login($user)) {
        $user->auth_key = \Yii::$app->security->generateRandomString();
        if ($user->save()) {
          return $user->auth_key;
        }

        throw new \Exception('Unable to save user with new auth key.');
      }

      throw new \Exception('Unable to login.');
    }

    throw new \Exception('Wrong username or password.');
  }

  public function actionLogout() {
    return \Yii::$app->user->logout();
  }

  /**
   * @inheritdoc
   */
  public function behaviors() {
    $behaviors = parent::behaviors();
    unset($behaviors['authenticator']);
    return $behaviors;
  }
}
