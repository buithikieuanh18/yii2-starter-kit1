<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tu_khoa".
 *
 * @property int $id
 * @property string $name
 * @property string|null $code
 */
class TuKhoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tu_khoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'code'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Từ khóa',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * Hàm liên kết giữa đối tượng từ khóa sản phẩm và từ khóa
    */

    public function getTuKhoaSanPhams()
    {
        return $this->hasMany(TuKhoaSanPham::class, ['tu_khoa_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        $this->code = API_Furniture::createCode($this->name);
        return parent::beforeSave($insert);
    }
}
