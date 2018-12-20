<?php

namespace backend\controllers;

use Yii;
use common\models\Page;
use common\models\Image;
use backend\models\Imageresize;
use backend\models\PageSearch;
use yii\bootstrap\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Translit;
use yii\filters\AccessControl;
/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
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
                        'roles' => ['admin','moderator','manager'],
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
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
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
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();
        $imagine   = new Imageresize();
        $image  = null;
        $imageModel=new Image();
        $transliterator= new Translit();
        $basePath='page'.'/'.date('Y').'/'.date('m').'/';
        $name=null;
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
                    $imageModel->path = $basePath;
                    $imageModel->name=$filenames;
                    $imageModel->save();
                    $image=$imageModel->id;
                    $imagine->imagerisize($uploadPath,$filenames,$file);
                    return $this->render('create', [
                        'model'     => $model,
                        'image'     =>  $image,
                        'path'      => $basePath,
                        'name'      => $filenames
                    ]);

                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $page=Yii::$app->request->post('Page');
             if(!isset($page['slug_page'])||$page['slug_page']==''){
                $slugs=$transliterator->traranslitSlug($page['title']);
                $model->slug_page=$slugs;
                
            }else{
                $model->slug_page=$page['slug_page'];
            }
            $model->save();
            if(isset($page['image'])){
                $imageModel->baseSave($basePath,'id_page',$model->id,$page['image']);
            }
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'image' => $image,
                'path'  => $basePath,
                'name'  => $name
            ]);
        }
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagine   = new Imageresize();
        $imageModel=new Image();
        $transliterator= new Translit();
        $basePath='page'.'/'.date('Y').'/'.date('m').'/';
        $imgModel=Image::findOne(['id_page'=>$id]);
        if(isset($imgModel))
            $name=$imgModel->name;
        else
            $name=false;
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
                    $imageModel->path = $basePath;
                    $imageModel->name=$filenames;
                    $imageModel->save();
                    $image=$imageModel->id;
                    $imagine->imagerisize($uploadPath,$filenames,$file);
                    return $this->render('create', [
                        'model'     => $model,
                        'image'     =>  $image,
                        'path'      => $basePath,
                        'name'      => $filenames
                    ]);

                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $page=Yii::$app->request->post('Page');
            if(!isset($page['slug_page'])||$page['slug_page']==''){
                $slugs=$transliterator->traranslitSlug($page['title']);
                $model->slug_page=$slugs;
            }else{
                $model->slug_page=$page['slug_page'];

            }
            $model->save();
           if(isset($page['image'])){
                if($page['image']!=''){
                    return var_dump($page['image']);
                    $imageModel->baseSave($basePath,'id_page',$model->id,$page['image']);
                }
            }
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'     => $model,
                'image'     => $name,
                'path'      => $basePath,
                'name'      => $name
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
