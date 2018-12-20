<?php

namespace backend\controllers;

use common\models\Page;
use Yii;
use common\models\Addlfeild;
use backend\models\AddlfeildSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Gods;
use common\models\Post;
use common\models\FrontendSetup;
use common\models\Category;
use yii\filters\AccessControl;
use yii\helpers\Json;
/**
 * AddlfeildController implements the CRUD actions for Addlfeild model.
 */
class AddlfeildController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
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
     * Lists all Addlfeild models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AddlfeildSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $feild=Yii::$app->request->get('class');
        $idrequest=Yii::$app->request->get("AddlfeildSearch");
        $id=$idrequest[$feild];
        $cat=false;
        if(Yii::$app->request->get('class')=='id_gods') {
            $goods = Gods::findOne($idrequest['id_gods']);
        }
        elseif(Yii::$app->request->get('class')=='id_post') {
            $goods = Post::findOne($idrequest['id_post']);
        }elseif(Yii::$app->request->get('class')=='id_page'){
            $goods = Page::findOne($idrequest['id_page']);
        }else {
            $goods = Category::findOne($idrequest['id_cat']);
            $cat=true;
        }
        if (Yii::$app->request->post('hasEditable')) {
            $bookId = Yii::$app->request->post('editableKey');
            $model = Addlfeild::findOne($bookId);
            $model->scenario = Addlfeild::SCENARIO_ALL;
            $out = Json::encode(['output'=>'', 'message'=>'']);
            $posted = current($_POST['Addlfeild']);
            $post = ['Addlfeild' => $posted];
            if ($model->load($post)) {
                $model->save();
                $output = '';
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }
            echo $out;
            return ;
        }
        return $this->render('index', [
            'searchModel'   =>  $searchModel,
            'dataProvider'  =>  $dataProvider,
            'class'         =>  $feild,
            'id'            =>  $id,
            'goods'         =>  $goods,
            'cat'           =>  $cat
        ]);
    }

    /**
     * Displays a single Addlfeild model.
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
     * Creates a new Addlfeild model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Addlfeild(['scenario' => Addlfeild::SCENARIO_ALL]);
        $feild=Yii::$app->request->get('feild');
        $id=Yii::$app->request->get('id');
        if ($model->load(Yii::$app->request->post())) {
            $model->$feild=$id;
            $model->save();
            return $this->redirect(['index','AddlfeildSearch['.$feild.']'=>$id,'class'=>$feild]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'feild' =>  $feild
            ]);
        }
    }
    
    public function actionRequired()
    {
        $model = new Addlfeild(['scenario' => Addlfeild::SCENARIO_REQUIRE]);
        $feild=Yii::$app->request->get('feild');
        $id=Yii::$app->request->get('id');
        if ($model->load(Yii::$app->request->post())) {
            $result=$model->requereSave(Yii::$app->request->post('Addlfeild'),$id);
            if($result){
                return $this->render('createrequired', [
                    'model' => $model,
                    'feild' =>  $feild,
                    'requere'=>$result
                ]);
            }else {
                return $this->redirect(['index', 'AddlfeildSearch['.$feild.']' => $id, 'class' => $feild]);
            }
        } else {
            return $this->render('createrequired', [
                'model' => $model,
                'feild' =>  $feild,
                'requere'=>false
            ]);
        }
    }

    /**
     * Updates an existing Addlfeild model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->scenario = Addlfeild::SCENARIO_ALL;
        if(isset($model->id_gods)){
            $feild='id_gods';
            $theId=$model->id_gods;
        }elseif(isset($model->id_post)){
            $feild='id_post';
            $theId=$model->id_post;
        }elseif(isset($model->id_page)){
            $feild='id_page';
            $theId=$model->id_page;
        }else{
            $feild='id_cat';
            $theId=$model->id_cat;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','AddlfeildSearch['.$feild.']' => $theId,'class' => $feild]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'feild' => $feild
            ]);
        }
    }
    public function actionOuther(){
        $proveder=ArrayHelper::map(FrontendSetup::find()->where(['description'=>'provider'])->asArray()->all(),'vaelye','vaelye');
        $model = new Addlfeild(['scenario' => Addlfeild::SCENARIO_ALL]);
        $feild=Yii::$app->request->get('feild');
        $id=Yii::$app->request->get('id');
        if ($model->load(Yii::$app->request->post())) {
            if($feild=='id_gods'){
                $model->id_gods=$id;
            }elseif($feild=='id_post') {
                $model->id_post = $id;
            }elseif ($feild=='id_page'){
                $model->id_page=$id;
            }else{
                $model->id_cat=$id;
            }
            $model->save();
            return $this->redirect(['index','AddlfeildSearch[id_gods]'=>$id,'class'=>$feild]);
        }else{
            return $this->render('outher',[
                'provider'  =>  $proveder,
                'model'     =>  $model
            ]);
        }
    }

    /**
     * Deletes an existing Addlfeild model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(isset($model->id_gods)){
            $feild='id_gods';
            $theId=$model->id_gods;
        }elseif(isset($model->id_post)) {
            $feild = 'id_post';
            $theId = $model->id_post;
        }elseif (isset($model->id_page)){
            $feild='id_page';
            $theId = $model->id_page;
        }else{
            $feild='id_cat';
            $theId=$model->id_cat;
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index','AddlfeildSearch['.$feild.']' => $theId,'class' => $feild]);
    }

    public function actionSize(){
        $addFields=Addlfeild::find()->where(['key_feild'=>'size1'])->with('goods','goods.categorys')->all();
        $goodsArr='\n\r';
        foreach ($addFields as $addField){
            if(empty($addField->frontendSetup)){
               if(isset($addField->goods->categorys)){
                if($addField->goods->categorys->size=='Одежда'){
                    $frontSet= new FrontendSetup([
                        'key_setup'=>$addField->value,
                        'vaelye'=>$addField->value,
                        'description'=>'size',
                    ]);
                    $frontSet->save();
                    unset($frontSet);
                }
            } 
            }
            
        } 
    }

    /**
     * Finds the Addlfeild model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Addlfeild the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Addlfeild::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
