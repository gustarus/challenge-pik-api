<?php

namespace app\modules\muffin\controllers;

use app\models\User;
use app\modules\muffin\components\BaseController;
use dektrium\user\models\RegistrationForm;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

class AuthController extends BaseController {

  /**
   * @return array
   * @throws \Exception
   */
  public function actionLogin() {
    $email = \Yii::$app->request->post('email');
    $password = \Yii::$app->request->post('password');

    $user = User::findByEmail($email);
    if (!$email || !$password || !$user) {
      throw new BadRequestHttpException('Invalid data passed.');
    } else if ($user->validatePassword($password)) {
      if (\Yii::$app->user->login($user)) {
        $user->auth_key = \Yii::$app->security->generateRandomString();
        if ($user->save()) {
          return ['id' => $user->id, 'token' => $user->auth_key];
        }

        throw new ServerErrorHttpException('Unable to save user with new auth key.');
      }

      throw new ServerErrorHttpException('Unable to login.');
    }

    throw new BadRequestHttpException('Wrong username or password.');
  }

  /**
   * @return bool
   * @throws BadRequestHttpException
   * @throws \Exception
   */
  public function actionRegister() {
    $model = new \dektrium\user\models\User();
    $model->setScenario('register');
    $model->attributes = \Yii::$app->request->post();
    $model->username = $model->email;
    if ($model->register()) {
      return true;
    }

    $errors = $model->getFirstErrors();
    throw new BadRequestHttpException(reset($errors));
  }

  public function actionLogout() {
    return \Yii::$app->user->logout();
  }
}
