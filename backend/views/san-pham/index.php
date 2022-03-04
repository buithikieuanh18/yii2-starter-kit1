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
                    [
                        'attribute' => 'anh_dai_dien',
                        'label' => 'Hình ảnh',
                        'value' => function($data) {
                            /** @var $data \common\models\SanPham  */
                            return Html::img('../../common/images/'.$data->anh_dai_dien, ['width' => '80px', 'height' => '80px']);
                        },
                        'format' => 'raw',
                        'filter' => false,
                    ],
                    //'anh_dai_dien',
                    //'id',
                    'name',
                    //'code',
                    //'mo_ta_ngan_gon',
                    //'mo_ta_chi_tiet:ntext',
                    [
                        'attribute' => 'ban_chay',
                        'value' => function($data) {
                            /** @var $data \common\models\SanPham  */
                            if($data->ban_chay)
                                return '<span class="text-success"><i class="fas fa-check"></i></span>';
                            return '<span class="text-danger"></span>';
                        },
                        'format' => 'raw',
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeDropDownList($searchModel, 'ban_chay', [
                            0 => 'Không bán chạy',
                            1 => 'Bán chạy'
                        ], ['prompt' => 'Tất cả', 'class' => 'form-control'])
                    ],
                    [
                        'attribute' => 'noi_bat',
                        'value' => function($data) {
                            /** @var \common\models\SanPham  $data  */
                            if($data->noi_bat)
                                return '<span class="text-success"><i class="fas fa-check"></i></span>';
                            return '<span class="text-danger"></span>';
                        },
                        'format' => 'raw',
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeDropDownList($searchModel, 'noi_bat', [
                            0 => 'Không nổi bật',
                            1 => 'Nổi bật'
                        ], ['prompt' => 'Tất cả', 'class' => 'form-control'])
                    ],
                    [
                        'attribute' => 'moi_ve',
                        'value' => function($data) {
                            /** @var \common\models\SanPham $data  */
                            if($data->moi_ve)
                                return '<span class="text-success"><i class="fas fa-check"></i></span>';
                            return '<span class="text-danger"></span>';
                        },
                        'format' => 'raw',
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeDropDownList($searchModel, 'moi_ve', [
                            0 => 'Hàng cũ',
                            1 => 'Mới về'
                        ], ['prompt' => 'Tất cả', 'class' => 'form-control'])
                    ],
                    //'ban_chay',
                    //'noi_bat',
                    //'moi_ve',
                    [
                        'attribute' => 'gia_ban',
                        'value' => function($data) {
                            /** @var \common\models\SanPham  $data */
                            
                            return number_format($data->gia_ban, 0, '', '.');
                        },
                        'headerOptions' => ['class' => 'text-right'],
                        'contentOptions' => ['class' => 'text-right'],
                        'filter' => Html::activeTextInput($searchModel, 'giaban_tu', ['class' => 'form-control', 'type' => 'number']).
                        Html::activeTextInput($searchModel, 'gia_ban', ['class' => 'form-control', 'type' => 'number']),
                    ],
                    //'gia_ban',
                    // 'gia_canh_tranh',
                    [
                        'attribute' => 'ngay_dang',
                        'value' => function($data) {
                            /** @var \common\models\SanPham $data  */
                            return date("d/m/Y", strtotime($data->ngay_dang));
                        },
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeTextInput($searchModel, 'ngay_dang_tu', ['class' => 'form-control']).
                        Html::activeTextInput($searchModel, 'ngay_dang', ['class' => 'form-control'])
                    
                    ],
                    // 'ngay_dang',
                    // 'ngay_sua',
                    // 'thuong_hieu_id',
                    [
                        'attribute' => 'thuong_hieu_id',
                        'value' => function($data) {
                            /** @var \common\models\SanPham $data  */
                            $thuongHieu = \common\models\ThuongHieu::findOne($data->thuong_hieu_id);
                            return $thuongHieu->name;
                            //return $data->thuongHieu->name;
                        },
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeDropDownList($searchModel, 'thuong_hieu_id', 
                        \yii\helpers\ArrayHelper::map(
                            \common\models\ThuongHieu::find()->all(), 'id', 'name'
                        ),
                        ['prompt' => 'Tất cả', 'class' => 'form-control'])
                    ],
                    // 'nguoi_tao_id',
                    // 'nguoi_sua_id',
                    // [
                    //     'value' => function($data) {
                    //         /** @var \common\models\SanPham $data  */
                    //         $phanLoai = [];
                    //         foreach($data->phanLoaiSanPhams as $phanLoaiSanPham) {
                    //             $phanLoai[] = $phanLoaiSanPham->phanLoai->name;
                    //         }
                    //         return implode(', ', $phanLoai);
                    //     },
                    //     'label' => 'Tags',
                    // ],

                    [
                        'class' => \common\widgets\ActionColumn::class,
                        'template' => '{view}',
                        'header' => 'Xem'
                    ],
                    [
                        'class' => \common\widgets\ActionColumn::class,
                        'template' => '{update}',
                        'header' => 'Sửa'
                    ],
                    [
                        'class' => \common\widgets\ActionColumn::class,
                        'template' => '{delete}',
                        'header' => 'Xóa'
                    ],
                ],
            ]); ?>
            <i class="bi bi-bag-check-fill"></i>
    
        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
