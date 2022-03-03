<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phan_loai_san_pham".
 *
 * @property int $id
 * @property int $phan_loai_id
 * @property int $san_pham_id
 */
class PhanLoaiSanPham extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phan_loai_san_pham';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phan_loai_id', 'san_pham_id'], 'required'],
            [['phan_loai_id', 'san_pham_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phan_loai_id' => 'Phan Loai ID',
            'san_pham_id' => 'San Pham ID',
        ];
    }
}
