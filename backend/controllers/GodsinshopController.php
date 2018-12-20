<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Addlfeild;
use common\models\Gods;
use common\models\Shop;
use Yii;
use common\models\Godsinshop;
use backend\models\GodsinshopSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\grid\EditableColumnAction;
/**
 * GodsinshopController implements the CRUD actions for Godsinshop model.
 */
class GodsinshopController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin','manager','moderator'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->session->setFlash('info', 'У вас нет прав доступа');
                    return $action->controller->redirect('/admin/user/security/login');
                },
            ],
        ];
    }

  
    /**
     * Lists all Godsinshop models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GodsinshopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model= new Godsinshop();
        $gods   =   Gods::find()->all();
        $shop   =   Shop::find()->all();
        $article = Addlfeild::find()->where(['key_feild'=>'article'])->all();
        $catrgory= Category::find()->all();
        return $this->render('index', [
            'model'         =>  $model,
            'searchModel'   =>  $searchModel,
            'dataProvider'  =>  $dataProvider,
            'gods'          =>  $gods,
            'shop'          =>  $shop,
            'article'       =>  $article,
            'category'      =>  $catrgory
        ]);
    }

    /**
     * Displays a single Godsinshop model.
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
     * Creates a new Godsinshop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Godsinshop();
        $gods   =   Gods::find()->with('addfeilds')->all();
        $shop   =   Shop::find()->all();
        if (Yii::$app->request->isAjax) {
          $id=Yii::$app->request->post('id');
            $goods=Gods::find()->where(['id'=>$id])->with('addfeilds')->one();
            $theGoods=$model->getgoods($goods);
            $color=$model->getcolor($goods->addfeilds);
            $size=$model->getsize($goods->addfeilds);

            return $this->render('create',[
                'model' => $model,
                'gods'  =>  $theGoods,
                'shop'  =>  $shop,
                'color' =>  $color,
                'size'  =>  $size,
                'id'    =>  $goods->id
            ]);
        }
        if ($model->load(Yii::$app->request->post())) {
            $post=Yii::$app->request->post('Godsinshop');
            $size=Yii::$app->request->post('size');
            $save=$model->saveModel($post,$size);
            if($save=='thetrue'){
                return $this->redirect(['index', 'id' => $model->id]);
            }else{
                return var_dump($save);
                }
        } else {
            return $this->render('create', [
                'model' => $model,
                'gods'          =>  $gods,
                'shop'          =>  $shop,
                'size'          =>  null,
                'color'         =>  null,
                'id'            =>  null,
            ]);
        }
    }

    /**
     * Updates an existing Godsinshop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->find()->where($id)->with('goods.addfeilds')->one();
        $gods   =   Gods::find()->all();
        $shop   =   Shop::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'gods'  =>  $gods,
                'shop'  =>  $shop,
            ]);
        }
    }

    /**
     * Deletes an existing Godsinshop model.
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
     * Finds the Godsinshop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Godsinshop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Godsinshop::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
