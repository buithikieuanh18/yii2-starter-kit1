<?php

/**
 * @var yii\web\View $this
 * @var common\models\Slider $model
 */

$this->title = 'Create Slider';
$this->params['breadcrumbs'][] = ['label' => 'Sliders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
