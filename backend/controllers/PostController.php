<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use backend\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Translit;
use backend\models\Imageresize;
use common\models\Image;
use yii\filters\AccessControl;
/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        $imagine   = new Imageresize();
        $image  = null;
        $imageModel=new Image();
        $transliterator= new Translit();
        $basePath='post'.'/'.date('Y').'/'.date('m').'/';
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
                    $imagine->imagerisizenews($uploadPath,$filenames,$file);
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
            if(isset($page['title'])){
                $slugs=$transliterator->traranslitSlug($page['title']);
                $model->slug_page=$slugs;
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
     * Updates an existing Post model.
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
        $basePath='post'.'/'.date('Y').'/'.date('m').'/';
        $imgModel=Image::findOne(['id_page'=>$id]);
        if(isset($imgModel)){
            $name=$imgModel->name;
        }else{
            $name=null;
        }

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
                    $imagine->imagerisizenews($uploadPath,$filenames,$file);
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
            $page=Yii::$app->request->post('Post');
            if(isset($page['title'])){
                $slugs=$transliterator->traranslitSlug($page['title']);
                $model->slug_post=$slugs;
                $model->save();
            }
            if(isset($page['image'])){
                $imageModel->baseSave($basePath,'id_page',$model->id,$page['image']);
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
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
