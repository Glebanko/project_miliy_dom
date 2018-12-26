<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.12.18
 * Time: 23:19
 */

namespace Shop\Services;

use Shop\Entities\Basket;
use Shop\Forms\BasketForm;
use Shop\Repositories\BasketRepository;
use Shop\Repositories\GoodsRepository;

class BasketService
{
    public $goodsRepository;
    public $basketRepository;
    public function __construct(GoodsRepository $goodsRepository,BasketRepository $basketRepository)
    {
        $this->goodsRepository=$goodsRepository;
        $this->basketRepository=$basketRepository;
    }

    public function IsGuest($goodsCookie)
    {

        $amount = count($goodsCookie['goods']);
        $goodsId=[];
        $goodsToCookie=[];
        foreach ($goodsCookie['goods'] as $good) {
            $goodsId[] = $good['idGoods'];
            $goodsToCookie[] = $good;
        }
        $goods=$this->goodsRepository->getGodsToBascet($goodsId);
        return [
            'goods' => $goods,
            'goodsId' => $goodsId,
            'goodsToCookie' => $goodsToCookie,
        ];
    }

    public function usertIdentity()
    {
        return['goods'=>$this->basketRepository->notConfirmed()];
    }

    public function create(BasketForm $form,int $userId):void
    {
        $basket= Basket::create($form->id,$userId,$form->price);
        $this->basketRepository->save($basket);
    }





}
