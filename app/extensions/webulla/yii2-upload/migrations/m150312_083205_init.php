<?php

namespace webulla\upload\migrations;

use yii\db\Migration;

class m150312_083205_init extends Migration {

  /**
   * @inheritdoc
   */
  public function up() {
    $this->createTable('{{%file}}', [
      'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'name' => 'VARCHAR(255) NOT NULL',
      'src' => 'TEXT NOT NULL',
      'size' => 'INT(8) NOT NULL',
      'mime_id' => 'INT UNSIGNED NOT NULL',
      'created_at' => 'DATETIME NOT NULL',
      'updated_at' => 'DATETIME NOT NULL',
    ]);

    $this->createTable('{{%file_mime}}', [
      'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
      'group' => 'VARCHAR(255) NOT NULL',
      'type' => 'VARCHAR(255) NOT NULL',
    ]);

    $this->addForeignKey('file_to_file_mime_idx', '{{%file}}', 'mime_id', '{{%file_mime}}', 'id');
  }

  /**
   * @inheritdoc
   */
  public function down() {
    $this->dropForeignKey('file_to_file_mime_idx', '{{%file}}');
    $this->dropTable('{{%file}}');
    $this->dropTable('{{%file_mime}}');
  }
}
