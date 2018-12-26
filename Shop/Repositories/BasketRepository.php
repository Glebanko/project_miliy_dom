<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.12.18
 * Time: 23:47
 */

namespace Shop\Repositories;

use Shop\Entities\Basket;

class BasketRepository
{
    public function notConfirmed():array
    {
        return Basket::find()
            ->with(['goods', 'goods.article', 'goods.image', 'goods.price', 'goods.size'])
            ->where(['confirmed' => '0'])
            ->asArray()
            ->all();
    }
    public function save(Basket $basket):Basket
    {
        if(!$basket->save()){
            throw new \RuntimeException(var_dump($basket->errors));
        }
        return $basket;
    }

}
