<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m241126_133309_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => 'int NOT NULL AUTO_INCREMENT',
            'image' => $this->string()->notNull(),
            'PRIMARY KEY(id)'

        ]);
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
