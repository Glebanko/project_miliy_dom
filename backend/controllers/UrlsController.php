<?php

namespace backend\controllers;

use common\models\Prise;
use Yii;
use common\models\FrontendSetup;
use backend\models\UrlsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Addlfeild;
/**
 * UrlsController implements the CRUD actions for FrontendSetup model.
 */
class UrlsController extends Controller
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
        $searchModel = new UrlsSearch();
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
        $manufacturer=ArrayHelper::map(Prise::find()->asArray()->all(),'sites','sites');
        if ($model->load(Yii::$app->request->post()) ) {
            $model->description='url';
            $model->save();
            return $this->redirect(['index', 'UrlsSearch[description]' => 'url']);
        } else {
            return $this->render('create', [
                'model'         =>  $model,
                'manufacturer'  =>  $manufacturer
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
        $manufacturer=ArrayHelper::map(Prise::find()->asArray()->all(),'sites','sites');
        if ($model->load(Yii::$app->request->post()) ) {
            $model->description='url';
            $model->save();
            return $this->redirect(['index', 'UrlsSearch[description]' => 'url']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'manufacturer'  =>  $manufacturer,
                'value' =>  $model->key_setup
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
