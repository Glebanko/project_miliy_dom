<?php

namespace backend\controllers;

use common\models\Image;
use Yii;
use common\models\Category;
use backend\models\Imageresize;
use backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dosamigos\transliterator\TransliteratorHelper;
use backend\models\Translit;
use yii\filters\AccessControl;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
                        'roles' => ['admin','moderator'],
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $parent = Category::find()->select('id, name')->all();
        $imagine   = new Imageresize();
        $image  = null;
        $imageModel=new Image();
        $transliterator= new Translit();
        $basePath='category/'.date('Y').'/'.date('m').'/';
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
                    $image=$imageModel;
                    $imagine->imagerisize($uploadPath,$filenames,$file);
                    return $this->render('create', [
                        'model'     => $model,
                        'image'     =>  $image,
                        'path'      => $basePath,
                        'name'      => $filenames,
                        'parent'    => $parent
                    ]);

                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $cat=Yii::$app->request->post('Category');
            if(empty($cat['slug_category'])){
                $slugs=$transliterator->traranslitSlug($cat['name']);
                $model->slug_category=$slugs;
            }else{
            	$model->slug_category=$cat['slug_category'];
            }
            if($cat['parrent_category']==null){
                $model->parrent_category=0;
            }
            $model->save();
            if(isset($cat['image'])){
                $save=$imageModel->baseSave($basePath,'id_cat',$model->id,$cat['image']);
            }
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'image' => $image,
                'path'  => $basePath,
                'name'  => $name,
                'parent'=> $parent
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $parent = Category::find()->select('id, name')->all();
        $imagine   = new Imageresize();
        $image  = null;
        $imageModel=new Image();$transliterator= new Translit();
        $basePath='category/'.date('Y').'/'.date('m').'/';
        $imgModel=Image::findOne(['id_cat'=>$id]);
        if(isset($imgModel)) {
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
                    $imagine->imagerisize($uploadPath,$filenames,$file);
                    return $this->render('create', [
                        'model'     => $model,
                        'image'     =>  $image,
                        'path'      => $basePath,
                        'name'      => $filenames,
                        'parent'    => $parent
                    ]);

                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $cat=Yii::$app->request->post('Category');
            if(empty($cat['slug_category'])){
                $slugs=$transliterator->traranslitSlug($cat['name']);
                $model->slug_category=$slugs;
               
            }else{
            	$model->slug_category=$cat['slug_category'];
            }
             $model->save();
            if(isset($cat['image'])){
                $imageModel->baseSave($basePath,'id_cat',$model->id,$cat['image']);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model'     => $model,
                'image'     => $name,
                'path'      => $basePath,
                'name'      => $name,
                'parent'    => $parent
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionInfo(){
        return phpinfo();
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
