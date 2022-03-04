<?php

namespace backend\controllers;

use common\models\PhanLoaiSanPham;
use Yii;
use common\models\SanPham;
use common\models\search\SanPham as SanPhamSearch;
use common\models\search\TuKhoa;
use common\models\TuKhoaSanPham;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * SanPhamController implements the CRUD actions for SanPham model.
 */
class SanPhamController extends Controller
{
    //public $anh_san_pham;
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all SanPham models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SanPhamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SanPham model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SanPham model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SanPham();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SanPham model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->phan_loai_san_phams = ArrayHelper::map(PhanLoaiSanPham::findAll(['san_pham_id' => $id]), 'phan_loai_id', 'phan_loai_id');
        
        $tukhoa_sanpham = TuKhoaSanPham::findAll(['san_pham_id' => $id]);
        $model->tu_khoa_san_phams = [];
        foreach($tukhoa_sanpham as $item) {
            //$tukhoa = TuKhoa::findOne($item->tu_khoa_id);
            $model->tu_khoa_san_phams[] = $item->tuKhoa->name; //$tukhoa->name;
        }
        $model->tu_khoa_san_phams = implode(',', $model->tu_khoa_san_phams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SanPham model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SanPham model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SanPham the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SanPham::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionXoaAnhDaiDien($idsp) {
        $san_pham = SanPham::findOne($idsp);
        if($san_pham->anh_dai_dien != 'no-image.jpg') {
            $path = '@common/images/'.$san_pham->anh_dai_dien;
            if (is_file($path)) {
                unlink($path);
                SanPham::updateAll(['anh_dai_dien' => 'no-image.jpg'], ['id' => $idsp]);
            }
        } else {
            Yii::$app->session->setFlash('thongbao', 'Không thể xóa ảnh của sản phẩm!');
        }
        $this->redirect(Url::toRoute(['san-pham/update', 'id' => $idsp]));
            
    }
}
