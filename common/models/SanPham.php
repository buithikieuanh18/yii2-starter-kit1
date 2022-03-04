<?php

namespace common\models;

use PHPUnit\Util\Log\TAP;
use Yii;
use yii\db\Expression;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "san_pham".
 *
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property string|null $mo_ta_ngan_gon
 * @property string|null $mo_ta_chi_tiet
 * @property int $ban_chay
 * @property int $noi_bat
 * @property int $moi_ve
 * @property float $gia_ban
 * @property float $gia_canh_tranh
 * @property string $anh_dai_dien
 * @property string|null $ngay_dang
 * @property string|null $ngay_sua
 * @property int $thuong_hieu_id
 * @property int $nguoi_tao_id
 * @property int $nguoi_sua_id
 * @property int $so_luong
 * @property string|null $ngay_hang_ve
 * 
 * @property AnhSanPham[] $anhSanPhams
 * @property DonHangChiTiet[] $donHangChiTiets
 * @property PhanLoaiSanPham[] $phanLoaiSanPhams
 * @property ThuongHieu $thuongHieu
 * @property User $nguoiTao
 * @property User $nguoiSua
 * @property TuKhoaSanPham[] $tuKhoaSanPhams
 */
class SanPham extends \yii\db\ActiveRecord
{
    public $anh_san_phams;
    public $phan_loai_san_phams;
    public $tu_khoa_san_phams;
    public $giaban_tu;
    public $ngay_dang_tu;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'san_pham';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anh_san_phams', 'phan_loai_san_phams', 'tu_khoa_san_phams', 'nguoi_tao_id', 'anh_dai_dien', 'nguoi_sua_id'], 'safe'],
            [['name', 'gia_ban', 'gia_canh_tranh', 'thuong_hieu_id','so_luong'], 'required', 'message' => '{attribute} không được để trống!'],
            [['mo_ta_chi_tiet', 'ngay_hang_ve'], 'string'],
            [['ban_chay', 'noi_bat', 'moi_ve', 'thuong_hieu_id', 'nguoi_tao_id', 'nguoi_sua_id'], 'integer'],
            [['gia_ban', 'gia_canh_tranh'], 'number'],
            [['ngay_dang', 'ngay_sua'], 'safe'],
            [['name', 'code'], 'string', 'max' => 150],
            [['mo_ta_ngan_gon'], 'string', 'max' => 500],
            //[['anh_dai_dien'], 'string', 'max' => 255],
            [['anh_dai_dien'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên sản phẩm',
            'code' => 'Code',
            'mo_ta_ngan_gon' => 'Mô tả ngắn gọn',
            'mo_ta_chi_tiet' => 'Mô tả chi tiết',
            'ban_chay' => 'Bán chạy',
            'noi_bat' => 'Nổi bật',
            'moi_ve' => 'Mới về',
            'gia_ban' => 'Giá bán',
            'gia_canh_tranh' => 'Giá cạnh tranh',
            'anh_dai_dien' => 'Ảnh đại diện',
            'ngay_dang' => 'Ngày đăng',
            'ngay_sua' => 'Ngày sửa',
            'thuong_hieu_id' => 'Thương hiệu',
            'nguoi_tao_id' => 'Người tạo',
            'nguoi_sua_id' => 'Người sửa',
            'ngay_hang_ve' => 'Ngày hàng về',
            'so_luong' => 'Số lượng',
            'anh_san_phams' => 'Ảnh sản phẩm',
            'phan_loai_san_phams' => 'Phân loại sản phẩm',
            'tu_khoa_san_phams' => 'Từ khóa sản phẩm',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getAnhSanPhams()
    {
        return $this->hasMany(AnhSanPham::classname(), ['san_pham_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getDonHangChiTiets()
    {
        return $this->hasMany(DonHangChiTiet::classname(), ['san_pham_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getPhanLoaiSanPhams()
    {
        return $this->hasMany(PhanLoaiSanPham::classname(), ['id' => 'phan_loai_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
    */
    public function getThuongHieu()
    {
        return $this->hasMany(ThuongHieu::classname(), ['id' => 'thuong_hieu_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
    */
    public function getNguoiSua()
    {
        return $this->hasMany(User::classname(), ['nguoi_sua_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getNguoiTao()
    {
        return $this->hasMany(User::classname(), ['nguoi_tao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getTuKhoaSanPhams()
    {
        return $this->hasMany(TuKhoaSanPham::classname(), ['san_pham_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if($insert){
            $this->ngay_dang = new Expression("NOW()");
            $this->nguoi_tao_id = 1; //Yii::$app->user->id;
        }else {
                $this->ngay_sua = new Expression("NOW()");
                $this->nguoi_tao_id = 1; //Yii::$app->user->id;
            }
        $this->ngay_hang_ve = API_Furniture::convertDMYtoYMD($this->ngay_hang_ve);
        $this->code = API_Furniture::createCode($this->name);
        $this->nguoi_sua_id = 1;
        #region upload file
        $file = UploadedFile::getInstance($this, 'anh_dai_dien');
        if(!is_null($file)) {
            $time = time();
            $type = API_Furniture::get_extension($file->type);
            $ten_file = API_Furniture::createCode($this->name);
            $ten_file = "{$time}_logo-{$ten_file}{$type}";
            $this->anh_dai_dien = $ten_file;
            if(!$insert) {
                $thuonghieu = self::findOne($this->id);
                Yii::$app->session->set('old_name_logo',$thuonghieu->anh_dai_dien);
            }
        } else {
            if($insert) {
                // không upload file
                $this->anh_dai_dien = 'no-image.jpg';
            } else {
                //update
                $thuonghieu = self::findOne($this->id);
                $this->anh_dai_dien = $thuonghieu->anh_dai_dien;
            }
        }
        #endregion
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        PhanLoaiSanPham::deleteAll(['san_pham_id' => $this->id]);
        foreach ($this->phan_loai_san_phams as $phan_loai_san_pham) {
            $plsp = new PhanLoaiSanPham();
            $plsp->phan_loai_id = $phan_loai_san_pham;
            $plsp->san_pham_id = $this->id;
            $plsp->save();
        }

        TuKhoaSanPham::deleteAll(['san_pham_id' => $this->id]);
        if($this->tu_khoa_san_phams != '') {
            $tukhoa = explode(', ', $this->tu_khoa_san_phams);
            foreach ($tukhoa as $item) {
                $old_tag = TuKhoa::findOne(['name' => trim($item)]);
                if(!is_null($old_tag)) {
                    $is_tukhoa = $old_tag->id;
                } else {
                    $new_tag = new TuKhoa();
                    $new_tag->name = $item;
                    $new_tag->save();
                    $id_tukhoa = $new_tag->id;
                }
                $tukhoa_sp = new TuKhoaSanPham();
                $id_tukhoa = $tukhoa_sp->tu_khoa_id;
                $tukhoa_sp->san_pham_id = $this->id;
                $tukhoa_sp->save();
            }
        }

        #region upload file anh dai dien
        $file = UploadedFile::getInstance($this, 'anh_dai_dien');
        if(!is_null($file)) {
            $ten_file = $this->anh_dai_dien;
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
        
        #endregion
        
        #region upload file anh lien quan
        $files = UploadedFile::getInstances($this, 'anh_san_phams');
        foreach ($files as $file) {
            $ten_file = time().$file->name;

            $anh_slider = new AnhSanPham();
            $anh_slider->san_pham_id = $this->id;
            $anh_slider->file = $ten_file;
            if ($anh_slider->save()) {
                // đường dẫn lưu ảnh
                $path = '@common/images/'.$ten_file;
                $file->saveAs($path);
            }
        }
        #endregion

        $this->nguoi_tao_id = 1;
        $this->nguoi_sua_id = 1;

        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
        // no-image.jpg
        if ($this->anh_dai_dien != 'no-image.jpg') {
            $path = '@common/images/'.$this->anh_dai_dien;
            if(is_file($path))
                unlink($path);
        }

        $anh_sliders = AnhSanPham::findAll(['san_pham_id' => $this->id]);
        foreach($anh_sliders as $anh_slider) {
            $anh_slider->delete();
        }

        TuKhoaSanPham::deleteAll(['san_pham_id' => $this->id]);
        PhanLoaiSanPham::deleteAll(['san_pham_id' => $this->id]);

        return parent::beforeDelete();
    }


}
