<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;


/**
 * @var yii\web\View $this
 * @var common\models\PhanLoai $model
 * @var yii\bootstrap4\ActiveForm $form
 * 
 * Khi lưu thông tin csdl nào đều qua các bước sau
 * Nhập dl -> BeforeSave -> save(data->database / trigger / procedure...) -> AfterSave
 * Convert d/m/Y -> Y-m-d
 * Gán id_user: Người đang đăng nhập và xử lý
 * Convert Name => Code
 * 
 * 
 * AfterSave: Lưu hình ảnh liên quan của bài viết, sp, slider...
 * Lấy id của đối tượng (Model) vừa lưu xong
 */
?>

<div class="phan-loai-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="card">
            <div class="card-body">
                <?php echo $form->errorSummary($model); ?>

                <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                
            </div>
            <div class="card-footer">
                <?php echo Html::submitButton($model->isNewRecord ? 'Lưu lại' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
