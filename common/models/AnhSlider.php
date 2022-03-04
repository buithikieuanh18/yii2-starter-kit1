<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "anh_slider".
 *
 * @property int $id
 * @property string|null $file
 * @property int $slider_id
 */
class AnhSlider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anh_slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slider_id'], 'required'],
            [['slider_id'], 'integer'],
            [['file'], 'string', 'max' => 255],
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
            'slider_id' => 'Slider ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlider() {
        return $this->hasOne(Slider::className(), ['id' => 'slider_id']);
    }

    public function afterDelete()
    {
        $path = '@common/images/'.$this->file;
        if(is_file($path)) {
            unlink($path);
        }
        parent::afterDelete();
    }
}
