<?php

use yii\db\Migration;

/**
 * Class m220301_113544_quan_li_slider
 */
class m220301_113544_quan_li_slider extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'tieu_de' => $this->string(100),
            'mo_ta' => $this->text(),
            'link' => $this->string(150),          
        ]);

        $this->createTable('{{%anh_slider}}', [
            'id' => $this->primaryKey(),
            'file' => $this->string(),
            'slider_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_slider', '{{%anh_slider}}', 'slider_id', '{{%slider}}', 'id', 'cascade', 'cascade');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_slider', '{{%anh_slider}}');

        $this->dropTable('{{%slider}}');
        $this->dropTable('{{%anh_slider}}');
    }
}
