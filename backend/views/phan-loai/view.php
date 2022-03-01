<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PhanLoai $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quản lý phân loại', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phan-loai-view">
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
                    'name',
                    'code',
                    
                ],
            ]) ?>
        </div>
    </div>
</div>
