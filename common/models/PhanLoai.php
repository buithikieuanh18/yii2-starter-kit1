<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phan_loai".
 *
 * @property int $id
 * @property string $name Tên nhóm sản phẩm
 * @property string|null $code
 * 
 * @property PhanLoaiSanPham[] $phanLoaiSanPhams
 */
class PhanLoai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phan_loai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên nhóm sản phẩm',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * Hàm liên kết giữa đối tượng phân loại sản phẩm và phân loại
    */

    public function getPhanLoaiSanPhams()
    {
        return $this->hasMany(PhanLoaiSanPham::class, ['phan_loai_id' => 'id']);
        // id trường phân loại sẽ lk vs trường phan_loai_id của phân loại sản phẩm
    }

    public function beforeSave($insert)
    {
        // convert name => code
        $this->code = API_Furniture::createCode($this->name);
        return parent::beforeSave($insert);
    }
}
