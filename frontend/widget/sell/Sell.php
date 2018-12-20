<?php

namespace frontend\widget\sell;

use yii\base\Widget;
use common\model\Category;
use Yii;
class Sell extends Widget{
    public function run(){
        $categoryGoods = Category::find()->asArray()->with(['sell.article', 'sell.image', 'sell.price', 'sell.size'])->where(['id'=>64])->all();
        return $this->render('html',['categoryGoods'=>$categoryGoods]);
    }
}

