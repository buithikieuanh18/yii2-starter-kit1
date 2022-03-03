<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "don_hang_chi_tiet".
 *
 * @property int $id
 * @property int $so_luong
 * @property float $don_gia
 * @property int $don_hang_id
 * @property int $san_pham_id
 */
class DonHangChiTiet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'don_hang_chi_tiet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['so_luong', 'don_gia', 'don_hang_id', 'san_pham_id'], 'required'],
            [['so_luong', 'don_hang_id', 'san_pham_id'], 'integer'],
            [['don_gia'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'so_luong' => 'So Luong',
            'don_gia' => 'Don Gia',
            'don_hang_id' => 'Don Hang ID',
            'san_pham_id' => 'San Pham ID',
        ];
    }
}
