<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Slider $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sliders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('Xóa', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'tieu_de',
                    'mo_ta:ntext',
                    'link',
                    
                ],
            ]) ?>
        </div>
    </div>
</div>
