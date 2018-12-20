<?php

namespace backend\controllers;

use common\models\Gods;
use common\models\Prise;
use Yii;
use common\models\FrontendSetup;
use backend\models\PaternSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaternController implements the CRUD actions for FrontendSetup model.
 */
class PaternController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FrontendSetup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaternSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FrontendSetup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FrontendSetup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FrontendSetup();
        $gods=ArrayHelper::map(Gods::find()->asArray()->all(),'id','title');
        if ($model->load(Yii::$app->request->post()) ) {
            $post=Yii::$app->request->post('FrontendSetup');
            if($post['goodsid']!='') {
                $goods = Gods::find()->where(['id'=>$post['goodsid']])->with('addfeilds','linesall.sheets.addfeilds','linesall.pillowcases.addfeilds','linesall.duvetscover.addfeilds')->one();
                $model->vaelye=json_encode($model->parentLines($goods));
            }
            $model->save();
            return $this->redirect(['index', 'FrontendSetupSearch[description]' => 'lines']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'gods'  => $gods,
                'prise' =>  ArrayHelper::map(Prise::find()->asArray()->all(),'id','name')
            ]);
        }
    }

    /**
     * Updates an existing FrontendSetup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $gods=ArrayHelper::map(Gods::find()->asArray()->all(),'id','title');
        if ($model->load(Yii::$app->request->post()) ) {
            $post=Yii::$app->request->post('FrontendSetup');
            if($post['goodsid']!='') {
                $goods = Gods::find()->where(['id'=>$post['goodsid']])->with('addfeilds','linesall.sheets','linesall.sheets.addfeilds','linesall.pillowcases','linesall.pillowcases.addfeilds','linesall.duvetscover','linesall.duvetscover.addfeilds')->one();
                $model->vaelye=json_encode($model->parentLines($goods));
            }
            $model->save();
            return $this->redirect(['index', 'FrontendSetupSearch[description]' => 'lines']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'gods'  => $gods,
                'prise' =>  ArrayHelper::map(Prise::find()->asArray()->all(),'id','name')
            ]);
        }
    }

    /**
     * Deletes an existing FrontendSetup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FrontendSetup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FrontendSetup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FrontendSetup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
