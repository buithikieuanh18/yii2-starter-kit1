<?php

namespace common\models;

use Codeception\Lib\Interfaces\API;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;

use Yii;

/**
 * This is the model class for table "thuong_hieu".
 *
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property string $logo
 */
class ThuongHieu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'thuong_hieu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['code'], 'string', 'max' => 255],
            [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'code' => 'Code',
            'logo' => 'Logo',
        ];
    }

    public function beforeSave($insert)
    {
        $this->code = API_Furniture::createCode($this->name);

        $file = UploadedFile::getInstance($this, 'logo');
        if(!is_null($file)) {
            $time = time();
            $type = API_Furniture::get_extension($file->type);
            $ten_file = API_Furniture::createCode($this->name);
            $ten_file = "{$time}_logo-{$ten_file}{$type}";
            $this->logo = $ten_file;
            if(!$insert) {
                $thuonghieu = self::findOne($this->id);
                Yii::$app->session->set('old_name_logo',$thuonghieu->logo);
            }
        } else {
            if($insert) {
                // không upload file
                $this->logo = 'no-image.jpg';
            } else {
                //update
                // Lấy lại gtri logo cũ
                $thuonghieu = self::findOne($this->id);
                //gán giá trị logo cũ bằng giá trị logo mới
                $this->logo = $thuonghieu->logo;
            }
        }

        return parent::beforeSave($insert);
    }

    // upload ảnh sau khi lưu dl vào csdl thành công
    public function afterSave($insert, $changedAttributes)
    {
        $file = UploadedFile::getInstance($this, 'logo');
        if(!is_null($file)) {
            $ten_file = $this->logo;
            $path = '@common/images/'.$ten_file;
            $file->saveAs($path);

            if(!$insert) {
                $ten_file_cu = Yii::$app->session->get('old_name_logo');
                if($ten_file_cu != 'no-image.jpg') {
                    $path = '@common/images/'.$ten_file_cu;
                    if(is_file($ten_file_cu))
                        unlink($path);
                }
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
        // no-image.jpg
        if ($this->logo != 'no-image.jpg') {
            $path = '@common/images/'.$this->logo;
            if(is_file($path))
                unlink($path);
        }
        return parent::beforeDelete();
    }
}
