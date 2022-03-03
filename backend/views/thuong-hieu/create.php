<?php

/**
 * @var yii\web\View $this
 * @var common\models\ThuongHieu $model
 */

$this->title = 'Tạo thương hiệu';
$this->params['breadcrumbs'][] = ['label' => 'Thương hiệu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thuong-hieu-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
