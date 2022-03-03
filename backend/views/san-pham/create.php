<?php

/**
 * @var yii\web\View $this
 * @var common\models\SanPham $model
 */

$this->title = 'Create sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="san-pham-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
