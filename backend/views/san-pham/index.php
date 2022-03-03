<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var common\models\search\SanPham $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="san-pham-index">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Create Sản phẩm', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <div class="card-body p-0">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
            <?php echo GridView::widget([
                'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => ['gridview', 'table-responsive'],
                ],
                'tableOptions' => [
                    'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    'code',
                    'mo_ta_ngan_gon',
                    'mo_ta_chi_tiet:ntext',
                    // 'ban_chay',
                    // 'noi_bat',
                    // 'moi_ve',
                    // 'gia_ban',
                    // 'gia_canh_tranh',
                    // 'anh_dai_dien',
                    // 'ngay_dang',
                    // 'ngay_sua',
                    // 'thuong_hieu_id',
                    // 'nguoi_tao_id',
                    // 'nguoi_sua_id',
                    
                    ['class' => \common\widgets\ActionColumn::class],
                ],
            ]); ?>
    
        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
