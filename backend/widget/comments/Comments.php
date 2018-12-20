<?php
namespace backend\widget\comments;

use yii\base\Widget;
use common\models\Comment;

class Comments extends Widget{
    public function init(){
        parent::init();
    }
    public function run(){
        $model=Comment::find()->orderBy(['created_at'=>SORT_DESC])->with('gods', 'user')->limit(10)->all();
        $count=Comment::find()->limit(10)->count();
        return $this->render('comment',[
            'models'=>$model,
            'count'=>$count
        ]);
    }
}