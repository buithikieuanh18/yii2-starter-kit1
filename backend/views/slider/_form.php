<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Slider $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="slider-form">
    <?php $form = ActiveForm::begin(
        [
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]
    ); ?>
    <?php 
    // beforeSave() ->save() -> afterSave(Lưu thông tin hình ảnh slider)
    ?>
        <div class="card">
            <div class="card-body">
                <?php echo $form->errorSummary($model); ?>

                <?php echo $form->field($model, 'tieu_de')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'mo_ta')->textarea(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                
                <?php echo $form->field($model, 'hinh_anhs[]')->fileInput(['multiple' => 'multiple']) ?>
                
            </div>
            <div class="card-footer">
                <?php echo Html::submitButton($model->isNewRecord ? 'Lưu lại' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
