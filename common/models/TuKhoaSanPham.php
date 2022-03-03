<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tu_khoa_san_pham".
 *
 * @property int $id
 * @property int $tu_khoa_id
 * @property int $san_pham_id
 */
class TuKhoaSanPham extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tu_khoa_san_pham';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tu_khoa_id', 'san_pham_id'], 'required'],
            [['tu_khoa_id', 'san_pham_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tu_khoa_id' => 'Tu Khoa ID',
            'san_pham_id' => 'San Pham ID',
        ];
    }
}
