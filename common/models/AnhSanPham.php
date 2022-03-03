<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "anh_san_pham".
 *
 * @property int $id
 * @property string $file
 * @property int $san_pham_id
 */
class AnhSanPham extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anh_san_pham';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file', 'san_pham_id'], 'required'],
            [['san_pham_id'], 'integer'],
            [['file'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file' => 'File',
            'san_pham_id' => 'San Pham ID',
        ];
    }
}
