<?php

use yii\db\Migration;

class m190616_143054_init extends Migration {
  
  public function safeUp() {
    $this->db->createCommand("
        CREATE TABLE IF NOT EXISTS {{%property}} (
          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
          `type` VARCHAR(255) NOT NULL,
          `title` VARCHAR(255) NOT NULL,
          `description` TEXT NULL,
          `address` TEXT NOT NULL,
          `square` DOUBLE UNSIGNED NOT NULL,
          `price` DOUBLE UNSIGNED NOT NULL,
          `created_at` DATETIME NOT NULL,
          `updated_at` DATETIME NOT NULL,
          `created_by` INT UNSIGNED NOT NULL,
          PRIMARY KEY (`id`),
          INDEX `property_to_created_by_idx` (`created_by` ASC)
        )
        ENGINE = InnoDB;
      ")->execute();

    $this->db->createCommand("
        CREATE TABLE IF NOT EXISTS {{%property_room}} (
          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
          `property_id` INT UNSIGNED NOT NULL,
          `type` VARCHAR(255) NOT NULL,
          `title` VARCHAR(255) NOT NULL,
          `description` VARCHAR(45) NULL,
          `created_at` DATETIME NOT NULL,
          `updated_at` DATETIME NOT NULL,
          PRIMARY KEY (`id`),
          INDEX `property_room_to_property_idx` (`property_id` ASC),
          CONSTRAINT `property_room_to_property`
            FOREIGN KEY (`property_id`)
            REFERENCES {{%property}} (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
        )
        ENGINE = InnoDB;
      ")->execute();

    $this->db->createCommand("
        CREATE TABLE IF NOT EXISTS {{%property_picture}} (
          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
          `property_id` INT UNSIGNED NOT NULL,
          `file_id` INT UNSIGNED NOT NULL,
          `created_at` DATETIME NOT NULL,
          `updated_at` DATETIME NOT NULL,
          PRIMARY KEY (`id`),
          INDEX `property_picture_to_property_idx` (`property_id` ASC),
          INDEX `property_picture_to_file_idx` (`file_id` ASC),
          CONSTRAINT `property_picture_to_property`
            FOREIGN KEY (`property_id`)
            REFERENCES {{%property}} (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
          CONSTRAINT `property_picture_to_file`
            FOREIGN KEY (`file_id`)
            REFERENCES {{%file}} (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
        )
        ENGINE = InnoDB;
      ")->execute();

    $this->db->createCommand("
        CREATE TABLE IF NOT EXISTS {{%property_room_picture}} (
          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
          `property_room_id` INT UNSIGNED NOT NULL,
          `file_id` INT UNSIGNED NOT NULL,
          `created_at` DATETIME NOT NULL,
          `updated_at` DATETIME NOT NULL,
          PRIMARY KEY (`id`),
          INDEX `property_room_picture_to_property_room_idx` (`property_room_id` ASC),
          INDEX `property_room_picture_to_file_idx` (`file_id` ASC),
          CONSTRAINT `property_room_picture_to_property_room`
            FOREIGN KEY (`property_room_id`)
            REFERENCES {{%property_room}} (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
          CONSTRAINT `property_room_picture_to_file`
            FOREIGN KEY (`file_id`)
            REFERENCES {{%file}} (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
        )
        ENGINE = InnoDB;
      ")->execute();
  }

  public function safeDown() {
    $this->db->createCommand("DROP TABLE IF EXISTS {{%property_room_picture}}")->execute();
    $this->db->createCommand("DROP TABLE IF EXISTS {{%property_picture}}")->execute();
    $this->db->createCommand("DROP TABLE IF EXISTS {{%property_room}}")->execute();
    $this->db->createCommand("DROP TABLE IF EXISTS {{%property}}")->execute();
  }
}
