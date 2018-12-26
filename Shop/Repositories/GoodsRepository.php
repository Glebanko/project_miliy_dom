<?php
namespace Shop\Repositories;

use common\model\Goods;
use rmrevin\yii\fontawesome\component\UnorderedList;
use Shop\Entities\Basket;

class GoodsRepository
{
    public function getGodsToBascet($goodsId):array
    {
        return  Goods::find()->with(['article', 'image', 'price', 'size'])->where(['id' => $goodsId])->asArray()->all();
    }



}
