<?php

namespace backend\controllers;

use common\models\Prise;
use Yii;
use common\models\FrontendSetup;
use backend\models\DefaulttableSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Translit;

/**
 * DefaulttableController implements the CRUD actions for FrontendSetup model.
 */
class DefaulttableController extends Controller
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
        $searchModel = new DefaulttableSearch();
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
        $transliterator= new Translit();
        $firmDefault=ArrayHelper::map(Prise::find()->asArray()->all(),'sites','sites');
        $basePath='tablesize/'.date('Y').'/'.date('m').'/';
        if (Yii::$app->request->isAjax) {
            $fileName = 'file';
            $uploadPath =Yii::getAlias('@frontend/web/image/').$basePath;
            if (isset($_FILES[$fileName])) {
                if (file_exists($uploadPath)) {
                } else {
                    mkdir($uploadPath, 0775, true);
                }
                $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                $filenames=$transliterator->traranslitImg($file);
                if ($file->saveAs($uploadPath . '/' . $filenames)) {
                    return $this->render('create', [
                        'model'     => $model,
                        'firmDefault'   =>  array_unique($firmDefault)
                    ]);
                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $post=Yii::$app->request->post('FrontendSetup');
            $model->vaelye=Yii::getAlias('@frontendWebroot/image/').''.$basePath.''.$post['vaelye'];
            $model->save();
            return $this->redirect(['index', 'DefaulttableSearch[description]' => 'tableDefault']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'firmDefault'   =>  array_unique($firmDefault)

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
        $transliterator= new Translit();
        $firmDefault=ArrayHelper::map(Prise::find()->asArray()->all(),'id','sites');
        $basePath='tablesize/'.date('Y').'/'.date('m').'/';
        if (Yii::$app->request->isAjax) {
            $fileName = 'file';
            $uploadPath =Yii::getAlias('@frontend/web/image/').$basePath;
            if (isset($_FILES[$fileName])) {
                if (file_exists($uploadPath)) {
                } else {
                    mkdir($uploadPath, 0775, true);
                }
                $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                $filenames=$transliterator->traranslitImg($file);
                if ($file->saveAs($uploadPath . '/' . $filenames)) {
                    return $this->render('create', [
                        'model'     => $model,
                        'firmDefault'   =>  array_unique($firmDefault)
                    ]);
                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $post=Yii::$app->request->post('FrontendSetup');
            $model->vaelye=Yii::getAlias('@frontendWebroot/image/').''.$basePath.''.$post['vaelye'];
            $model->save();
            return $this->redirect(['index', 'DefaulttableSearch[description]' => 'tableDefault']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'firmDefault'   =>  $firmDefault
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
