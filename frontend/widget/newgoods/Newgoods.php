<?php

namespace frontend\widget\newgoods;

use backend\models\Goods;
use yii\base\Widget;
use backend\models\Category;
use Yii;
class Newgoods extends Widget{
    public function run(){
        $categoryGoods = Goods::find()->asArray()->with(['article', 'image', 'price', 'size'])->limit(6)->orderBy(['id'=>SORT_DESC])->all();
        return $this->render('html',['categoryGoods'=>$categoryGoods]);
    }
}