<?php

/**
 * @var yii\web\View $this
 * @var common\models\PhanLoai $model
 */

use yii\helpers\Html;

$this->title = 'Thêm phân loại';
$this->params['breadcrumbs'][] = ['label' => 'Quản lý danh mục', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phan-loai-create">
    
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
