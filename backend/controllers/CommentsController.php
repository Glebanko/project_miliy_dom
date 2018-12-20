<?php

namespace backend\controllers;

use common\models\Gods;
use common\models\User;
use Yii;
use common\models\Comment;
use backend\models\CommentsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentsController implements the CRUD actions for Comment model.
 */
class CommentsController extends Controller
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
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $comments=Comment::find()->select(['id_gods','user_id'])->asArray()->all();
        $idgoods=array();
        $idusers=array();
        foreach ($comments as $comment){
            $idgoods[]=$comment['id_gods'];
            $idusers[]=$comment['user_id'];
        }
        $goods=ArrayHelper::map(Gods::find()->where(['in','id',$idgoods])->asArray()->all(),'id','title');
        $user=ArrayHelper::map(User::find()->where(['in','id',$idusers])->asArray()->all(),'id','username');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'goods' => $goods,
            'user'  =>  $user,
        ]);
    }

    /**
     * Displays a single Comment model.
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
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comment();
        $comments=Comment::find()->select(['id_gods','user_id'])->asArray()->all();
        $idgoods=array();
        $idusers=array();
        foreach ($comments as $comment){
            $idgoods[]=$comment['id_gods'];
            $idusers[]=$comment['user_id'];
        }
        $goods=ArrayHelper::map(Gods::find()->asArray()->all(),'id','title');
        $user=ArrayHelper::map(User::find()->asArray()->all(),'id','username');
        if ($model->load(Yii::$app->request->post())) {
             $post=Yii::$app->request->post('strtotimes');
            if(isset($post)){
                $model->created_at=strtotime($post);
            }else{
                $model->created_at=time();
            }
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'goods' => $goods,
                'user'  =>  $user,
            ]);
        }
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $comments=Comment::find()->select(['id_gods','user_id'])->asArray()->all();
        $idgoods=array();
        $idusers=array();
        foreach ($comments as $comment){
            $idgoods[]=$comment['id_gods'];
            $idusers[]=$comment['user_id'];
        }
        $goods=ArrayHelper::map(Gods::find()->asArray()->all(),'id','title');
        if(isset($model->id_gods)) {
            $dataGoods = ArrayHelper::map(Gods::find()->where(['id'=>$model->id_gods])->asArray()->one(), 'id', 'title');
        }else{
            $dataGoods=null;
        }
        $user=ArrayHelper::map(User::find()->asArray()->all(),'id','username');
        $dataUser=ArrayHelper::map(User::find()->where(['id'=>$model->user_id])->asArray()->all(),'id','username');
        if ($model->load(Yii::$app->request->post()) ) {
            $post=Yii::$app->request->post('strtotimes');
            if(isset($post)){
                $model->created_at=strtotime($post);
            }else{
                $model->created_at=time();
            }
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                return var_dump($post['strtotimes']);
            }
            
            
        } else {
            return $this->render('update', [
                'model' => $model,
                'goods' => $goods,
                'user'  =>  $user,
                'dataGoods' =>$dataGoods,
                'dataUser'  =>$dataUser
            ]);
        }
    }

    /**
     * Deletes an existing Comment model.
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
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
