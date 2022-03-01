<?php

use yii\db\Migration;

/**
 * Class m220301_111630_quan_li_san_pham
 */
class m220301_111630_quan_li_san_pham extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%san_pham}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'code' => $this->string(150),
            'mo_ta_ngan_gon' => $this->string(500),
            'mo_ta_chi_tiet' => $this->text(),
            'ban_chay' => $this->boolean()->notNull()->defaultValue(0),
            'noi_bat' => $this->boolean()->notNull()->defaultValue(0),
            'moi_ve' => $this->boolean()->notNull()->defaultValue(0),
            'gia_ban' => $this->double()->notNull(),
            'gia_canh_tranh' => $this->double()->notNull(),
            'anh_dai_dien' => $this->string()->notNull(),
            'ngay_dang' => $this->dateTime(),
            'ngay_sua' => $this->dateTime(),
            'thuong_hieu_id' => $this->integer()->notNull(),
            'nguoi_tao_id' => $this->integer()->notNull(),
            'nguoi_sua_id' => $this->integer()->notNull(),
            
        ]);
        $this->createTable('{{%phan_loai}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code' => $this->string(),
        ]);

        $this->createTable('{{%phan_loai_san_pham}}', [
            'id' => $this->primaryKey(),
            'phan_loai_id' => $this->integer()->notNull(),
            'san_pham_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%tu_khoa}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'code' => $this->string(45),
        ]);

        $this->createTable('{{%tu_khoa_san_pham}}', [
            'id' => $this->primaryKey(),
            'tu_khoa_id' => $this->integer()->notNull(),
            'san_pham_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%thuong_hieu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'code' => $this->string(),
            'logo' => $this->string(100)->notNull()->defaultValue('no-image.jpg'),
        ]);

        $this->createTable('{{%anh_san_pham}}', [
            'id' => $this->primaryKey(),
            'file' => $this->string(100)->notNull(),
            'san_pham_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%vai_tro_san_pham}}', [
            'id' => $this->primaryKey(),
            'vai_tro' => $this->string(100)->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        //'fk_furniture', <tên bảng có khóa phụ>, <tên khóa phụ>, <tên bảng có khóa chính cần nối đến>, <tên khóa chính>
        $this->addForeignKey('fk_nguoi_tao', '{{%san_pham}}', 'nguoi_tao_id', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_nguoi_sua', '{{%san_pham}}', 'nguoi_sua_id', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_thuong_hieu', '{{%san_pham}}', 'thuong_hieu_id', '{{%thuong_hieu}}', 'id', 'cascade', 'cascade');
        
        $this->addForeignKey('fk_phan_loai', '{{%phan_loai_san_pham}}', 'phan_loai_id', '{{%phan_loai}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_san_pham', '{{%phan_loai_san_pham}}', 'san_pham_id', '{{%san_pham}}', 'id', 'cascade', 'cascade');
        
        $this->addForeignKey('fk_tu_khoa', '{{%tu_khoa_san_pham}}', 'tu_khoa_id', '{{%tu_khoa}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_san_pham1', '{{%tu_khoa_san_pham}}', 'san_pham_id', '{{%san_pham}}', 'id', 'cascade', 'cascade');
        
        $this->addForeignKey('fk_san_pham2', '{{%anh_san_pham}}', 'san_pham_id', '{{%san_pham}}', 'id', 'cascade', 'cascade');
        
        $this->addForeignKey('fk_user', '{{%vai_tro_san_pham}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_nguoi_tao', '{{%san_pham}}');
        $this->dropForeignKey('fk_nguoi_sua', '{{%san_pham}}');
        $this->dropForeignKey('fk_thuong_hieu', '{{%san_pham}}');
        $this->dropForeignKey('fk_phan_loai', '{{%phan_loai_san_pham}}');
        $this->dropForeignKey('fk_san_pham', '{{%phan_loai_san_pham}}');
        $this->dropForeignKey('fk_tu_khoa', '{{%tu_khoa_san_pham}}');
        $this->dropForeignKey('fk_san_pham1', '{{%tu_khoa_san_pham}}');
        $this->dropForeignKey('fk_san_pham2', '{{%anh_san_pham}}');
        $this->dropForeignKey('fk_user', '{{%vai_tro_san_pham}}');

        $this->dropTable('{{%san_pham}}');
        $this->dropTable('{{%phan_loai}}');
        $this->dropTable('{{%phan_loai_san_pham}}');
        $this->dropTable('{{%tu_khoa}}');
        $this->dropTable('{{%tu_khoa_san_pham}}');
        $this->dropTable('{{%anh_san_pham}}');
        $this->dropTable('{{%vai_tro_san_pham}}');
        $this->dropTable('{{%thuong_hieu}}');

    }
}
