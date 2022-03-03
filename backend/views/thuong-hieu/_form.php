<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use trntv\filekit\widget\Upload;
use yii\web\JsExpression;

/**
 * @var yii\web\View $this
 * @var common\models\ThuongHieu $model
 * @var yii\bootstrap4\ActiveForm $form
 * 
 * create -> ínert
 * update -> update
 * insert / update: beforeSave() -> save() -> afterSave()
 * delete -> delete
 * beforeSave() không upload logo: logo: time().<ten-thuong-hieu>.<duoi-file> (.jpg, .png)
 */
?>

<div class="thuong-hieu-form">
    <?php $form = ActiveForm::begin(
        [
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]
    ); ?>
        <div class="card">
            <div class="card-body">
                <?php echo $form->errorSummary($model); ?>

                <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?php //echo $form->field($model, 'logo')->widget(
                //Upload::class,
                //[
                    //'url' => ['/file/storage/upload'],
                    //'maxFileSize' => 5000000, // 5 MiB,
                   // 'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
                //]
           // ) ?>

                <?php echo $form->field($model, 'logo')->fileInput(['maxlength' => true]) ?>
                <!-- Hiển thị ảnh logo -->
                <?php //if(!$model->isNewRecord): ?>
                    <?php //=Html::img(Yii::getAlias(dirname(dirname(dirname(__DIR__))).'\common\images\\').$model->logo, ['alt'=>'logo','width'=>'150px', "height"=>"150px"]) ?>
                <?php //endif ?>
            </div>
            <div class="card-footer">
                <?php echo Html::submitButton($model->isNewRecord ? 'Lưu lại' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
