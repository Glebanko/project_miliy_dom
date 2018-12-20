<?php

namespace backend\controllers;

use backend\models\Parser;
use backend\models\Parserphp;
use backend\models\Urlpriceparser;
use common\models\Addlfeild;
use common\models\Category;
use common\models\Catgodpost;
use common\models\FrontendSetup;
use common\models\Prise;
use Yii;
use common\models\Gods;
use backend\models\GodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use dosamigos\transliterator\TransliteratorHelper;
use backend\models\Imageresize;
use common\models\Image;
use backend\models\Translit;
use yii\base\ErrorException;
use Intervention\Image\ImageManager;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\filters\AccessControl;
use Zelenin\yii\SemanticUI\widgets\GridView;


/**
 * GodsController implements the CRUD actions for Gods model.
 */
class GodsController extends Controller
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

    public  function beforeAction($action) {
        $this->enableCsrfValidation = ($action->id !== "parser");
        return parent::beforeAction($action);
    }

    /**
     * Lists all Gods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GodsSearch();
        $model=new Gods();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $article = ArrayHelper::map(Addlfeild::find()->where(['key_feild'=>'article'])->asArray()->all(),'id','value');
        //$parentCat=ArrayHelper::map(Category::find()->where(['parrent_category'=>0])->asArray()->all(),'id','name');
        //$goodsIds=$model->getGoodsIdsByProviders();
        $nameProvider=ArrayHelper::map(FrontendSetup::find()->where(['description' => 'provider'])->asArray()->all(),'key_setup','vaelye');
        $cat=ArrayHelper::map(Category::find()->asArray()->all(),'id','name');
        $prise=Prise::find()->all();
            $site=ArrayHelper::map($prise,'sites','sites');
            $priseDatas=ArrayHelper::map($prise,'id','name');


        $size1=ArrayHelper::map(Addlfeild::find()->where(['key_feild'=>'size1'])->asArray()->all(),'value','value');
        $sessons=['nullSesson'=>'Ни одного']+Addlfeild::$season  ;
        if (Yii::$app->request->post('hasEditable')) {
            $bookId = Yii::$app->request->post('editableKey');
            $model = Gods::findOne($bookId);
            $out = Json::encode(['output'=>'', 'message'=>'']);
            $posted = current($_POST['Gods']);
            $post = ['Gods' => $posted];
            if ($model->load($post)) {
                $model->save();
                $output = '';
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }
            echo $out;
            return ;
        }
        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'article'       =>  $article,
            //'parentCat'     =>  $parentCat,
            'cat'           =>  $cat,
            'model'         => $model,
            'site'          =>  array_unique($site),
            'priseDatas'    =>  $priseDatas,
            'nameProvider'  =>  $nameProvider,//array_unique ($nameProvider)
            'size1'         =>  $size1,
            'sessons'       =>  $sessons
        ]);
    }

    /**
     * Displays a single Gods model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $goods= $this->findModel($id);
        $goods->scenario = Gods::SCENARIO_SEASSON;
        $seasons=Addlfeild::find()
            ->where(['id_gods'=>$id]
            )->andWhere(['in','key_feild',array_keys(Addlfeild::$season)])
            ->all();

        $goods->seasons= ArrayHelper::getColumn($seasons,'key_feild');
        if($goods->load(Yii::$app->request->post())){
            try{
                if(!$goods->save())
                    throw new \RuntimeException(var_dump($goods->errors));
                Yii::$app->session->setFlash('success','Изменения применились');
            }catch(\RuntimeException $e) {
                Yii::error($e);
                Yii::$app->session->setFlash('error','Изменения не сохранились');
            }
        }
        Yii::error(Addlfeild::seasonArraySelect($seasons));
        return $this->render('view', [
            'model' =>$goods,
            'seasons'=>Addlfeild::seasonArraySelect($seasons),

        ]);
    }

    /**
     * Creates a new Gods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gods();
        $imagine   = new Imageresize();
        $image  = null;
        $imageModel=new Image();
        $addfeild= new Addlfeild();
        $prise=new Prise();
        $allPrice=ArrayHelper::map(Prise::find()->asArray()->all(),'id','name');
        $transliterator= new Translit();
        $categorys=Category::find()->all();
        $basePath='gods/'.date('Y').'/'.date('m').'/';
        $catgods= new Category();
        $tableSize=ArrayHelper::map(FrontendSetup::find()->where(['description'=>'tablesize'])->asArray()->all(),'id','key_setup');
        $theCatGods= new Catgodpost();
        $currency=ArrayHelper::map(FrontendSetup::find()->where(['description'=>'currency'])->asArray()->all(),'id','key_setup');
        $sizeInSelect=ArrayHelper::map(FrontendSetup::find()->where(['description'=>'size'])->asArray()->all(),'id','vaelye');
        $colorInSelect=ArrayHelper::map(FrontendSetup::find()->where(['description'=>'color'])->asArray()->all(),'vaelye','key_setup');
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
                    $imageModel->path =  $basePath;
                    $imageModel->name=$filenames;
                    $imageModel->save();
                    $imagine->imagerisizegods($uploadPath,$filenames,$file);
                    return $this->render('create', [
                        'model'     => $model,
                        'image'     =>  $image,
                        'prise'     =>  $prise,
                        'addfeild'  =>  $addfeild,
                        'allPrice'  =>  $allPrice,
                        'categorys' =>  $categorys,
                        'catgods'    =>  $catgods,
                        'currency'  =>  $currency,
                        'tablesize' =>  $tableSize,
                        'sizeInSelect'  =>  $sizeInSelect,
                        'colorInSelect' =>  $colorInSelect
                    ]);
                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {

            $addfeildPost=Yii::$app->request->post('Addlfeild');
            $category = Yii::$app->request->post('Gods');
            $idCat=Yii::$app->request->post('Category');
            if(isset($category['title'])){
                $slugs=$transliterator->traranslitSlug($category['title']);
                $model->slug_gods='goods-'.$slugs;
                if($category['have']!=0){
                    $model->have=1;
                }
            }
            if(isset(Yii::$app->user->id))
                $model->user_id=Yii::$app->user->id;
                $descriptions = strip_tags($category['discription_gods']);
                $descriptions = str_replace("&nbsp;",' ',$descriptions);
                $descriptions = substr($descriptions, 0, 250);
                $descriptions = substr($descriptions, 0, strrpos($descriptions, ' '));
            $model->quote=$descriptions;
            if(isset($category['linens'])){
                $model->sets=1;
            }
            if(isset($category['viewsTS'])&&$category['viewsTS']!=0){
                $model->viewsTS=$category['viewsTS'];
            }
            $model->upedate_at=time();
            if($model->save()){
                if(isset($category['size'])&&$category['size']!="")
                    $model->saveSize($category['size'],$model->id);
                if(isset($category['colors']))
                    $model->saveColor($category['colors'],$model->id);
                if(isset($idCat)){
                    $theCatGods->saveCat($idCat['id'],$model->id);
                }
                if(isset($category['image'])){
                    $imageModel->baseSave($basePath,'id_gods',$model->id,$category['image']);
                }
                if($category['linens']==1){
                    return $this->redirect(['lines','id'=>$model->id]);
                }else{
                    return $this->redirect('index');
                }
                return $this->redirect('index');
            }else{
                Yii::$app->session->setFlash('error', print_r($model->getErrors(),1));
                return $this->render('create', [
                    'model'     =>  $model,
                    'image'     =>  $image,
                    'prise'     =>  $prise,
                    'addfeild'  =>  $addfeild,
                    'allPrice'  =>  $allPrice,
                    'categorys' =>  $categorys,
                    'catgods'    =>  $catgods,
                    'currency'  =>  $currency,
                    'tablesize' =>  $tableSize,
                    'sizeInSelect'  =>  $sizeInSelect,
                    'colorInSelect' =>  $colorInSelect
                ]);
            }

        } else {
            return $this->render('create', [
                'model'     =>  $model,
                'image'     =>  $image,
                'prise'     =>  $prise,
                'addfeild'  =>  $addfeild,
                'allPrice'  =>  $allPrice,
                'categorys' =>  $categorys,
                'catgods'    =>  $catgods,
                'currency'  =>  $currency,
                'tablesize' =>  $tableSize,
                'sizeInSelect'  =>  $sizeInSelect,
                'colorInSelect' =>  $colorInSelect
            ]);
        }
    }
    /**
     * Updates an existing Gods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagine   = new Imageresize();
        $image  = null;
        $imageModel=new Image();
        $prise=new Prise();
        $addfeild= new Addlfeild();
        $allPrice=ArrayHelper::map(Prise::find()->asArray()->all(),'id','name');
        $onePrice= Prise::find()->where(['id'=>$model->id_prise])->one();
        $transliterator= new Translit();
        $imageone=Image::findOne(['id_gods'=>$id]);
        $categorys=Category::find()->all();
        $color=Addlfeild::find()->where(['id_gods'=>$id])->andWhere(['key_feild'=>'color'])->all();
        $catgods= new Category();
        $tableSize=ArrayHelper::map(FrontendSetup::find()->where(['description'=>'tablesize'])->asArray()->all(),'id','key_setup');
        $theCatGods= new Catgodpost();
        $currency=ArrayHelper::map(FrontendSetup::find()->where(['description'=>'currency'])->asArray()->all(),'id','key_setup');
        $sizeInSelect=ArrayHelper::map(FrontendSetup::find()->where(['description'=>'size'])->asArray()->all(),'id','vaelye');
        $colorInSelect=ArrayHelper::map(FrontendSetup::find()->where(['description'=>'color'])->asArray()->all(),'vaelye','key_setup');
        if(isset($imageone)) {
            $basePath = $imageone->path;
        }else{
            $basePath='gods/'.date('Y').'/'.date('m').'/';
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
                $filenames=TransliteratorHelper::process($file->name, '', 'en');
                if ($file->saveAs($uploadPath . '/' . $filenames)) {
                    $imageModel->path = $basePath;
                    $imageModel->name=$filenames;
                    $imageModel->save();
                    $imagine->imagerisize($uploadPath,$filenames,$file);
                    return $this->render('create', [
                        'model'     => $model,
                        'image'         =>  $image,
                        'prise'         =>  $prise,
                        'allPrice'      =>  $allPrice,
                        'addfeild'      =>  $addfeild,
                        'onePrice'      =>  $onePrice,
                        'color'         =>  $color,
                        'categorys'     => $categorys,
                        'catgods'       =>  $catgods,
                        'currency'      =>  $currency,
                        'tablesize'     =>  $tableSize,
                        'sizeInSelect'  =>  $sizeInSelect,
                        'colorInSelect' =>  $colorInSelect
                    ]);
                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $addfeildPost=Yii::$app->request->post('Addlfeild');
            $category = Yii::$app->request->post('Gods');
            $gods=Yii::$app->request->post('Gods');
            $idCat=Yii::$app->request->post('id');
            $descriptions = strip_tags($category['discription_gods']);
            $descriptions = str_replace("&nbsp;",' ',$descriptions);
            $descriptions = substr($descriptions, 0, 300);
            $descriptions = substr($descriptions, 0, strrpos($descriptions, ' '));

            $slugs=$transliterator->traranslitSlug($category['title']);
            $model->slug_gods='goods-'.$slugs;

            if(isset(Yii::$app->user->id))
                $model->user_id=Yii::$app->user->id;
            if(isset($gods['table_size'])){
                $model->table_size=$gods['table_size'];
            }
            $model->upedate_at=time();
            $model->quote=$descriptions;
            if($category['linens']==1)
                $model->linenes=1;
            else
                $model->linenes=0;
            if(isset($gods['pregmath'])){
                $model->pregmath=$gods['pregmath'];
            }
            $model->currency=$gods['currency'];
            if(isset($category['viewsTS'])&&$category['viewsTS']!=0){
                $model->viewsTS=$category['viewsTS'];
            }
            $model->save();

             if(isset($category['size']))

                $sizeSave=$model->saveSize($category['size'],$model->id);
            if(isset($sizeSave))
                return var_dump($sizeSave);

            if(isset($category['colors'])){
                $model->saveColor($category['colors'],$model->id);
            }else{
                $model->delColor($model->id);
            }
            if(isset($category['image'])){
                $imageModel->baseSave($basePath,'id_gods',$model->id,$category['image']);
            }
            if(isset($idCat)){
                $theCatGods->saveCat($idCat,$id);
            }
            if($category['linens']==1){
                return $this->redirect(['lines','id'=>$model->id]);
            }else{
                return $this->redirect('index');
                }
        } else {
            return $this->render('update', [
                'model'     =>  $model,
                'image'     =>  $image,
                'prise'     =>  $prise,
                'addfeild'  =>  $addfeild,
                'allPrice'  =>  $allPrice,
                'onePrice'  =>  $onePrice,
                'color'     =>  $color,
                'categorys' =>  $categorys,
                'catgods'    =>  $catgods,
                'currency'  =>  $currency,
                'tablesize' =>  $tableSize,
                'sizeInSelect'  =>  $sizeInSelect,
                'colorInSelect' =>  $colorInSelect
            ]);
        }
    }

    /**
     * Deletes an existing Gods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    public function actionParser()
    {
        $execelparser = new Parser();
        if ($execelparser->load(Yii::$app->request->post())) {
            $parsers = Yii::$app->request->post('Parser');
            $execelparser->files = UploadedFile::getInstance($execelparser, 'files');
            $years = date('Y');
            $mounts = date('m');
            $path = 'files';
            $files_to = TransliteratorHelper::process($execelparser->files->name, '', 'en');
            if (file_exists(Yii::getAlias('@frontend/web/') . $path . '/' . $years . '/' . $mounts . '/')) {
            } else {
                mkdir(Yii::getAlias('@frontend/web/') . $path . '/' . $years . '/' . $mounts . '/', 0777, true);
            }
            foreach ($execelparser->files as $file) {
                $files_to = TransliteratorHelper::process($execelparser->files->name, '', 'en');
                if ($execelparser->upload($path, $years, $mounts, $files_to)) {
                   $xmlParse= $execelparser->XMLparses(Yii::getAlias('@frontend/web/').$path.'/'.$years.'/'.$mounts.'/'.$files_to);
                }else{
                    return var_dump($execelparser->files);
                }
            }
            return $this->render('parser',[
                'model'     => $execelparser,
                'priseparser'=>$xmlParse,
                'manufacturer'=>false
            ]);
        }else{
            return $this->render('parser',[
                'model'     => $execelparser,
                'priseparser'=>false,
                'manufacturer'=>false
            ]);
        }
    }
    public function actionParserprice()
    {
        $execelparser = new Parser();
        try{
            $xmlParse= $execelparser->actionParser();
            return var_dump($xmlParse);
        }catch(\RuntimeException $ex){
            return var_dump($ex->getMessage());
        }
    }


    public function  actionAddprovider(){
        $gods=Gods::find()->all();
        foreach ($gods as $goods) {
            if(isset($goods->prise->sites)) {
                if ($goods->prise->sites == 'барабашово' || $goods->prise->sites == 'барабашово ') {
                    $fields = Addlfeild::find()->where(['id_gods' => $goods->id, 'key_feild' => 'name_provider'])->one();
                    if (isset($fields)) {
                        $qwery = FrontendSetup::find()->where(['key_setup' => $fields->value, 'vaelye' => $fields->value])->all();
                        if(empty($qwery)) {
                            $providerSave = new FrontendSetup([
                                'key_setup' => $fields->value,
                                'vaelye' => $fields->value,
                                'description' => 'provider'
                            ]);
                            $providerSave->save();
                        }
                    }
                }
            }
        }
    }
    public function actionRedactlines()
    {
        $category = Category::find()->all();
        foreach ($category as $category) {
            if ($category->name == 'Простыни' || $category->name == 'Пододеяльники' || $category->name == 'Покрывала' || $category->name == 'Подушки' || $category->name == 'Пляжные полотенца' || $category->name == 'Наволочки' || $category->name == 'Одеяла' || $category->name == 'Кухонные полотенца' || $category->name == 'Банные полотенца' || $category->name == 'Лицевые полотенца') {
                foreach ($category->gods as $goods) {
                    $goods->sets = 2;
                    $goods->save();
                }
            } else if ($category->name == 'Постельное белье') {
                foreach ($category->gods as $goods) {
                    $goods->sets = 1;
                    $goods->save();
                }
            } else {
            }
        }
    }
    public function actionLines($id){
        $goods=Gods::findOne($id);
        $paterns=ArrayHelper::map(FrontendSetup::find()->where(['key_setup'=>'lines'])->asArray()->all(),'id','description');
        $model= new Gods();
        if($model->load(Yii::$app->request->post())){
            $post= Yii::$app->request->post('Gods');
            if(isset($post['patern'])){
                $patern=FrontendSetup::findOne($post['patern']);
                $saves = $model->addLinenesJson($goods, Json::decode($patern->vaelye, $asArray = false));
                if($saves){
                    return var_dump($saves);
                }else{
                    return $this->render('addlines',[
                        'price'     =>  ArrayHelper::map(Prise::find()->asArray()->all(),'id','name'),
                        'model'     =>  $model,
                        'paterns'   =>  $paterns
                    ]);

                }
            }else {
                $saves = $model->addLinenes($goods, $post);
                if($saves){
                    return var_dump($saves);
                }else{
                    return $this->render('addlines',[
                        'price'     =>  ArrayHelper::map(Prise::find()->asArray()->all(),'id','name'),
                        'model'     =>  $model,
                        'paterns'   =>  $paterns
                    ]);

                }
            }


        }
        return $this->render('addlines',[
            'price'     =>  ArrayHelper::map(Prise::find()->asArray()->all(),'id','name'),
            'model'     =>  $model,
            'paterns'   =>  $paterns
        ]);
    }
    /**
     * Finds the Gods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
