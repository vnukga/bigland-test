<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plot}}`.
 */
class m200429_151908_create_plot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%plot}}', [
            'id' => $this->primaryKey(),
            'cadastralNumber' => $this->string(20)->notNull(),
            'address' => $this->string(255)->notNull(),
            'price' => $this->decimal(10,4)->notNull(),
            'area' => $this->decimal(10,4)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%plot}}');
    }
}
