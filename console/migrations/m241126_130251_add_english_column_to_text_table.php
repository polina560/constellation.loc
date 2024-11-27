<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%text}}`.
 */
class m241126_130251_add_english_column_to_text_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%text}}',
            'en_value',
            $this->string()->comment('Значение текстового поля на английском')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%text}}', 'en_value');
    }
}
