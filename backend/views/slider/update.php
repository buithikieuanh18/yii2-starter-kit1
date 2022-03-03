<?php

/**
 * @var yii\web\View $this
 * @var common\models\Slider $model
 */

$this->title = 'Update Slider: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sliders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slider-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
