<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\TuKhoa $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Từ khóa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tu-khoa-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
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
