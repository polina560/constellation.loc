<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%constellation}}`.
 */
class m241126_125449_create_constellation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%constellation}}', [
            'id' => $this->primaryKey()->notNull(),
            'coordinates' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'en_title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'en_description' => $this->string()->notNull(),
            'image' => $this->string()->notNull(),
            'user_photo' => $this->string(),
            'status' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%constellation}}');
    }
}
