<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%constellation}}`.
 */
class m241126_143901_add_token_id_column_to_constellation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%constellation}}',
            'token_id',
            $this->string()->comment('ID в виде токена')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%constellation}}', 'token_id');
    }
}
