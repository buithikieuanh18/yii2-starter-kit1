<?php

namespace common\models;

use Yii;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string|null $tieu_de
 * @property string|null $mo_ta
 * @property string|null $link
 * 
 * @property AnhSlider[] $anhSliders 
 */
class Slider extends \yii\db\ActiveRecord
{
    public $hinh_anhs;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mo_ta'], 'string'],
            [['tieu_de'], 'string', 'max' => 100],
            [['link'], 'string', 'max' => 150],
            [['hinh_anhs'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tieu_de' => 'Tiêu đề',
            'mo_ta' => 'Mô tả tóm tắt',
            'link' => 'Link',
            'hinh_anhs' => 'Hình ảnh'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnhSliders()
    {
        return $this->hasMany(AnhSlider::className(), ['slider_id' => 'id']);
    }

    // public function beforeSave($insert)
    // {
    //     $files = UploadedFile::getInstances($this, 'hinh_anhs');
    //     foreach ($files as $file) {
    //         VarDumper::dump($file->name, 10, true);
            
    //     }
    //     exit;
    //     return parent::beforeSave($insert);
    // }
    public function afterSave($insert, $changedAttributes)
    {
        $files = UploadedFile::getInstances($this, 'hinh_anhs');
        foreach ($files as $file) {
            $ten_file = time().$file->name;

            $anh_slider = new AnhSlider();
            $anh_slider->slider_id = $this->id;
            $anh_slider->file = $ten_file;
            if ($anh_slider->save()) {
                // đường dẫn lưu ảnh
                $path = '@common/images/'.$ten_file;
                $file->saveAs($path);
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
