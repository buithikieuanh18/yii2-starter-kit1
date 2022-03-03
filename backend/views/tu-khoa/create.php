<?php

/**
 * @var yii\web\View $this
 * @var common\models\TuKhoa $model
 */

$this->title = 'Tạo từ khóa';
$this->params['breadcrumbs'][] = ['label' => 'Từ khóa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tu-khoa-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
