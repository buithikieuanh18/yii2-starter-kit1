<?php

use yii\db\Migration;

/**
 * Class m220301_111836_quan_li_don_hang
 */
class m220301_111836_quan_li_don_hang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%don_hang}}', [
            'id' => $this->primaryKey(),
            'ho_ten' => $this->string(60)->notNull(),
            'dien_thoai' => $this->string(20)->notNull(),
            'email' => $this->string(150),
            'dia_chi' => $this->string(200)->notNull(),
            'ngay_dat' => $this->dateTime()->notNull(),
            'tong_tien' => $this->double()->notNull(),
            'note' => $this->text(),
            'ship' => $this->double()->notNull()->defaultValue(0),
            'vat' => $this->double()->notNull()->defaultValue(0),
            'thanh_tien' => $this->double()->notNull()->defaultValue(0),
            'chiet_khau' => $this->string()->notNull()->defaultValue(0),
            'kieu_chiet_khau' => "ENUM('Tiền mặt', 'Phần trăm')",
            'hinh_thuc_thanh_toan' => "ENUM('Tiền mặt', 'Chuyển khoản')",
            'tinh_trang' => "ENUM('Đang chờ xử lý', 'Đang xử lý', 'Đang giao hàng', 'Hủy')",
            'ly_do_huy' => $this->text(),
            'tong_so_luong_san_pham' => $this->integer()->notNull()->defaultValue(0),            
        ]);

        $this->createTable('{{%don_hang_chi_tiet}}', [
            'id' => $this->primaryKey(),
            'so_luong' => $this->integer()->notNull(),
            'don_gia' => $this->double()->notNull(),
            'don_hang_id' => $this->integer()->notNull(),
            'san_pham_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_don_hang', '{{%don_hang_chi_tiet}}', 'don_hang_id', '{{%don_hang}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_san_pham', '{{%don_hang_chi_tiet}}', 'san_pham_id', '{{%san_pham}}', 'id', 'cascade', 'cascade');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_don_hang', '{{%don_hang_chi_tiet}}');
        $this->dropForeignKey('fk_san_pham', '{{%don_hang_chi_tiet}}');

        $this->dropTable('{{%don_hang}}');
        $this->dropTable('{{%don_hang_chi_tiet}}');
    }
}
