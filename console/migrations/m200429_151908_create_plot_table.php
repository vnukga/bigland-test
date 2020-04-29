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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%plot}}', [
            'id' => $this->primaryKey(),
            'cadastralNumber' => $this->string(20)->notNull(),
            'address' => $this->string()->notNull(),
            'price' => $this->decimal(10,4)->notNull(),
            'area' => $this->decimal(10,4)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%plot}}');
    }
}
