<?php

use yii\db\Migration;

class m190616_133502_init_user_admin extends Migration {

  protected $fields = [
    'username' => 'admin',
    'email' => 'admin@example.com',
    'password_hash' => '$2y$10$GIXiFqYICBIOlw49PV2NWOn9BI61MnOuAqJsIfpJXy4RkYqRWA4Qq',
    'auth_key' => 'BWWJGSJqEXEwrOXPaiiTTYp8NQ7YODAa',
    'confirmed_at' => 1,
    'created_at' => 1,
    'updated_at' => 1,
    'flags' => 0,
  ];

  public function safeUp() {
    $this->insert('{{%user}}', $this->fields);
  }

  public function safeDown() {
    $this->delete('{{%user}}', ['username' => $this->fields['username']]);
  }
}
