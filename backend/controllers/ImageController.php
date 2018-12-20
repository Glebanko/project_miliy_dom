<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Post;
use Yii;
use common\models\Image;
use backend\models\ImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\News;
use backend\models\Imageresize;
use backend\models\Translit;
use yii\filters\AccessControl;
use common\models\Gods;
/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
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
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $requestId= Yii::$app->request->get('ImageSearch');
        $feild=Yii::$app->request->get('feild');
        $id=$requestId[$feild];
        if(Yii::$app->request->get('class')=='gods') {
            $goods = Gods::findOne($requestId['id_gods']);
            $id_goods=$requestId['id_gods'];
            $cat=false;
        }
        elseif(Yii::$app->request->get('class')=='post') {
            $goods = Post::findOne($requestId['id_post']);
            $id_goods=$requestId['id_post'];
            $cat=false;
        }
        else {
            $goods = Category::findOne($requestId['id_cat']);
            $id_goods=$requestId['id_cat'];
            $cat=true;
        }

        $class=Yii::$app->request->get('class');
        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'feild'         =>  $feild,
            'id'            =>  $id,
            'class'         =>  $class,
            'id_goods'      =>  $id_goods,
            'goods'         =>  $goods,
            'cat'           =>  $cat
        ]);
    }

    /**
     * Displays a single Image model.
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
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Image();
        $imagine   = new Imageresize();
        $image  = null;
        $imageModel=new Image();
        $transliterator= new Translit();
        $basePath=Yii::$app->request->get('feild').'/'.date('Y').'/'.date('m').'/';
        $baseFeild=Yii::$app->request->get('basefeild');
        $class=Yii::$app->request->get('feild');
        $id=Yii::$app->request->get('id');
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
                if ($file->saveAs($uploadPath . $filenames)) {
                    if($class=='post'){
                        $imagine->imagerisizenews($uploadPath,$filenames,$file);
                    }else{
                        $imagine->imagerisizegods($uploadPath,$filenames,$file);
                    }
                    return $this->render('create', [
                        'model'     => $model,
                        'image'     =>  $image,
                        'feild'     =>  Yii::$app->request->get('basefeild'),
                        'class'     =>  Yii::$app->request->get('feild'),

                    ]);
                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $post=Yii::$app->request->post('Image');

            $model->saveimg($id,$basePath,$post['name'],$post['forHome'],$post['forFancy'],$baseFeild);
            return $this->redirect(['index', "ImageSearch[$baseFeild]" => $id,'class'=>$class,'feild'=>$baseFeild]);
        } else {
            $id=Yii::$app->request->get('id');
            return $this->render('create', [
                'model' => $model,
                'image'     =>  $image,
                'feild'=>Yii::$app->request->get('basefeild'),
                'class'     =>  Yii::$app->request->get('feild'),
            ]);
        }
    }

    /**
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagine   = new Imageresize();
        switch ($model){
            case isset($model->id_gods):
                $ids=$model->id_gods;
                $baseFeild='id_gods';
                $class='gods';
                break;
            case isset($model->id_post):
                $ids=$model->id_post;
                $baseFeild='id_post';
                $class='post';
                break;
            case isset($model->id_page):
                $ids=$model->id_page;
                $baseFeild='id_page';
                $class='page';
                break;
            default:
                $ids=$model->id_cat;
                $baseFeild='cat_id';
                $class='cat';
        }

        $image  = null;
        $transliterator= new Translit();
        $basePath=$class.'/'.date('Y').'/'.date('m').'/';
        $modelFeild=explode('/',$basePath);
        if (Yii::$app->request->isAjax) {
            $fileName = 'file';
            $uploadPath =Yii::getAlias('@frontend/web/image/').$basePath;
            if (isset($_FILES[$fileName])) {
                if (file_exists($uploadPath)) {
                } else {
                    BaseFileHelper::createDirectory($uploadPath, 0775, true);
                }
                $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                $filenames=$transliterator->traranslitImg($file);
                if ($file->saveAs($uploadPath . '/' . $filenames)) {
                    if($class=='post'){
                        $imagine->imagerisizenews($uploadPath,$filenames,$file);
                    }else{
                        $imagine->imagerisizegods($uploadPath,$filenames,$file);
                    }
                    return $this->render('update', [
                        'model'     => $model,
                        'image'     =>  $image,
                        'path'      => $basePath,
                        'name'      => $filenames,
                        'feild'     => $modelFeild[0],
                        'id'        =>  $id,
                        'class'=> $id
                    ]);
                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $post=Yii::$app->request->post('Image');
            $model->saveimg($model->id_gods,$basePath,$post['name'],$post['forHome'],$post['forFancy'],$baseFeild);
            return $this->redirect(['index', "ImageSearch[$baseFeild]"=> $ids,'class'=>$modelFeild[0],'feild'=>$baseFeild]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'feild'=> $modelFeild[0],
                'class'=> $id
            ]);
        }
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(isset($model->id_cat)){
            $baseFeild='cat_id';
            $class='cat';
        } elseif ($model->id_gods){
            $baseFeild='id_gods';
            $class='gods';
        }else{
            $baseFeild='id_post';
            $class='post';
        }
        $basePath=$model->path;
        $modelFeild=explode('/',$basePath);
        $this->findModel($id)->delete();
        return $this->redirect(['index', "ImageSearch[$baseFeild]"=> $model->id_gods,'class'=>$class,'feild'=>$baseFeild]);
    }

    public function  actionAddimage(){
        $model = new Image();
        $gods=News::find()->select('id,  img1, img2, img3, img4, img5, img6, img7 ')->all();
        return $this->render('parser',[
            'gods'=>$gods,
            'model'=>$model
        ]);
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
