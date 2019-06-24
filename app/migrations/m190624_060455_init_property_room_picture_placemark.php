<?php

use yii\db\Migration;

class m190624_060455_init_property_room_picture_placemark extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->db->createCommand("
            CREATE TABLE IF NOT EXISTS {{%property_room_picture_placemark}} (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `property_room_picture_id` INT UNSIGNED NOT NULL,
              `title` VARCHAR(255) NOT NULL,
              `x` INT NOT NULL,
              `y` INT NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME NOT NULL,
              PRIMARY KEY (`id`),
              INDEX `property_room_picture_placemark_to_property_room_picturee_idx` (`property_room_picture_id` ASC),
              CONSTRAINT `property_room_picture_placemark_to_property_room_picture`
                FOREIGN KEY (`property_room_picture_id`)
                REFERENCES {{%property_room_picture}} (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
            )
            ENGINE = InnoDB;
      ")->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%property_room_picture_placemark}}');
    }
}
