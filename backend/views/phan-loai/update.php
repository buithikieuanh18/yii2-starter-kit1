<?php

/**
 * @var yii\web\View $this
 * @var common\models\PhanLoai $model
 */

$this->title = 'Update phân loại: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quản lý phân loại', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phan-loai-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
