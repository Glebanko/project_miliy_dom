<?php
namespace backend\widget\order;


use yii\base\Widget;
use Yii;
use common\models\Orders;

class Order extends Widget{
    public function init(){
        parent::init();
    }
    public function run(){

        $order=Orders::find()->where(['received_sell'=>0])->andWhere(['or',['not',['user_id'=>null]],['not',['anonim_id'=>null]]])->with('baskets','baskets.gods','baskets.gods.images','baskets.colors', 'baskets.sizes','baskets.prises')->orderBy(['datetime'=>SORT_ASC])->all();
        $orderCount=Orders::find()->where(['received_sell'=>0])->andWhere(['or',['not',['user_id'=>null]],['not',['anonim_id'=>null]]])->count();
        return $this->render('html',[
            'count'=>$orderCount,
            'orders'=>$order,
        ]);
    }
}