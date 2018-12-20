<?php

namespace frontend\widget\hit;

use yii\base\Widget;
use common\model\Category;
use Yii;
class Hit extends Widget{
    public function run(){
       $categoryGoods = Category::find()->asArray()->with(['hit.article', 'hit.image', 'hit.price', 'hit.size'])->where(['id'=>67])->all();
        return $this->render('html',['categoryGoods'=>$categoryGoods]);
    }
}

