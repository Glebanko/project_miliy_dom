<?php
namespace backend\models;
use common\models\Gods;
use common\models\Prise;
use backend\components\Snoopy;
use yii\base\Model;
use yii\base\ErrorException;
use PHPHtmlParser\Dom;
//use HtmlParser\Parser;
class Urlpriceparser extends Model{
    public function parsersprase(){
        $goods=Gods::find()->where(['not',['Pregmath'=>null]])->andWhere(['not',['Pregmath'=>'']])->with('prise')->all();
        $firstArray=array();
        foreach ($goods as $good){
            $firstArray['goods'][$good->id]['url']=$good->url;
            $firstArray['goods'][$good->id]['id_price']=$good->id_prise;
            $firstArray['goods'][$good->id]['pattern']=$good->pregmath;
            $firstArray['goods'][$good->id]['id']=$good->id;
            $firstArray['goods'][$good->id]['pluss']=$good->pluss;
            $firstArray['price'][$good->id_prise]=$this->getPrice($good->prise);
        }
        foreach ($firstArray['goods'] as $arrGoods){
            $resultArr[]=$this->getPage($arrGoods);
        }
        return $resultArr;
    }

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
              if($result->status=='200'){
                $resultArr[$arrGoods['id_price']]=$this->getArrPrice($result->results,$arrGoods['pattern']);
            }else{
                $resultArr[$arrGoods['id']]='error 404';
            }
        }catch(ErrorException $e){
            return var_dump($e);
        }
        return  $resultArr;

    }
    private function getArrPrice($html,$pattern){
        $dom= new Dom();
        $dom->load($html);
        $price=$dom->find($pattern);
        return $price;
    }
}