<?php
namespace backend\models;

//use frontend\widget\price\Price;
use common\models\Prise;
use yii\base\Model;
use yii\console\Controller;
use common\models\FrontendSetup;
use common\models\Gods;
use yii\base\Exception;
use Yii;
use Intervention\Image\Exception\NotFoundException;
use yii\helpers\ArrayHelper;

class Parser extends Model
{
    public function actionParser()
    {
        $url_xml = FrontendSetup::find()->select(['vaelye'])->where(['description' => 'url'])->all();
        $dateParse = date('z', time());
        $currency = ArrayHelper::map(FrontendSetup::find()->where(['description' => 'currency'])->asArray()->all(),
            'key_setup', 'vaelye');
        $have = [];
        $goods=Gods::find()->andWhere(['not', ['url' => null]])->all();
        foreach ($url_xml as $xml) {
            $have = array_merge($have, $this->getXmlTrue($xml->vaelye, $currency));
        }
        unset($url_xml);
        unset($currency);
        $goodsArr=[];
        foreach ($goods as $onegoods){
            if(!empty($onegoods->prise)){
                $arrGoods['url']=$onegoods->url;
                $arrGoods['id']=$onegoods->prise->id;
                $arrGoods['price']=$onegoods->prise->price1;
                $goodsArr[]=$arrGoods;
            }
        }
        unset($goods);
        $priceArr=$this->priceArr($goodsArr,$have);
        unset($goodsArr);
        unset($have);
        $transaction = Yii::$app->db->beginTransaction();
        try {
            return $this->saveAll($priceArr);
            $transaction->commit();
            return var_dump('yes');
        } catch (\RuntimeException $ex) {
            $transaction->rollBack();
            return var_dump($ex->getMessage());
        }
    }

    public function getXmlTrue($files, $currency)
    {
        libxml_use_internal_errors(true);
        if(!simplexml_load_file($files)){
            $errors=array();
            foreach (libxml_get_errors() as $error) {
                $er['error']=$error;
                $er['site']=$files;
                $errors[]=$er;
            }
            libxml_clear_errors();
        }
        $xml = simplexml_load_file($files);
        if (is_object($xml)) {
            $result = [];
            foreach ($xml->shop->offers->offer as $offer) {
                if ($offer->attributes()->available == true) {
                    $result[(string)$offer->url] = $offer->price * (int)$currency[(string)$offer->currencyId];
                }
            }
            unset($xml);
            return $result;
        } else {
            throw new \RuntimeException('не найденно xml');
        }
    }

    public function getXmlFalse($files)
    {
        libxml_use_internal_errors(true);
        if(!simplexml_load_file($files)){
            $errors=array();
            foreach (libxml_get_errors() as $error) {
                $er['error']=$error;
                $er['site']=$files;
                $errors[]=$er;
            }
            libxml_clear_errors();
        }
        $xml = simplexml_load_file($files);
        if (is_object($xml)) {
            $result = [];
            foreach ($xml->shop->offers->offer as $offer) {
                if ($offer->attributes()->available != true) {
                    $result[] = (string)$offer->url;
                }
            }
            return $result;
        } else {
            throw new \RuntimeException('не найденно xml');
        }
    }

    private function saveAll($priceArr)
    {
        foreach ($priceArr as $price){
            $prise=Prise::findOne($price['id']);
            $prise->price1=$price['price1'];
            if(!$prise->save())
                throw new \RuntimeException(print_r($price->errors,1));
        }

    }

    private function priceArr($priceArr,$xmlArr){
        $returnArr=[];
        foreach ($priceArr as $arrPrice){
            if(!empty($xmlArr[$arrPrice['url']])){
                if($xmlArr[$arrPrice['url']]>$arrPrice['price']){
                    $arr['price1']=$xmlArr[$arrPrice['url']];
                    $arr['id']=$arrPrice['id'];
                    $returnArr[]=$arr;
                }
            }
        }
        return $returnArr;
    }
}

