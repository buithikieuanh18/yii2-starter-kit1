<?php

/**
 * @var yii\web\View $this
 * @var common\models\ThuongHieu $model
 */

$this->title = 'Cập nhật thương hiệu: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Thương hiệu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="thuong-hieu-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
