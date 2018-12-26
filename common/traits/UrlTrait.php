<?php
namespace common\traits;

use PHPHtmlParser\Dom;
use backend\components\Snoopy;
use yii\base\ErrorException;
trait UrlTrait
{
    private function getPrice($price){
        $result=0;
        switch ($price) {
            case ($price->price1 != 0):
                    $result = $price->price1;
                break;
            case ($price->price2 != 0):
                    $result = $price->price2;
                break;
            case ($price->priceEvro != 0):
                    $result =  $price->priceEvro;
                break;
            case ($price->priceSem != 0):
                    $result =  $price->priceSem;
                break;
            case ($price->wholesale != 0):
                    $result =  $price->wholesale;
                break;

        }
        return $result;
    }

    private function getPage($arrGoods){
        $snoopy= new Snoopy();
        $snoopy->agent= "Mozilla/5.0 (Windows; U; Windows NT 6.1; uk; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13 Some plugins";
        try{
            $result=$snoopy -> fetch($arrGoods['url']);
            if($result->response_code=='HTTP/1.1 200 OK'){
                $result[$arrGoods['id_price']]=$this->getArrPrice($result,$arrGoods['pattern']);
            }else{
                $resultArr[$arrGoods['id']]='error 404';
            }
        }catch(ErrorException $e){
            $result[404]='error';
        }


        //$saveArr=$this->getText();
        return $result;
    }
    private function getArrPrice($html,$pattern){
        $dom= new Dom();
        $dom->load($html);
        $price=$dom->find($pattern);
        return $price;
    }
}