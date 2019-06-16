<?php

namespace app\models;

use dektrium\user\helpers\Password;

class User extends \dektrium\user\models\User {

  /**
   * @param String $username
   * @return User
   */
  public static function findByUsername($username) {
    return self::find()->andWhere(['username' => $username])->one();
  }

  /**
   * @param String $email
   * @return User
   */
  public static function findByEmail($email) {
    return self::find()->andWhere(['email' => $email])->one();
  }

  /**
   * @param $token
   * @param null $type
   * @return User
   */
  public static function findIdentityByAccessToken($token, $type = null) {
    $user = static::findOne(['auth_key' => $token]);
    if (!$user->isBlocked && $user->isConfirmed) {
      return $user;
    }

    return null;
  }

  /**
   * @param String $password
   * @return bool
   */
  public function validatePassword($password) {
    return Password::validate($password, $this->password_hash);
  }
}
