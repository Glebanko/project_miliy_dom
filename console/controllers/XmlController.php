<?php
namespace console\controllers;

use common\models\Prise;
use yii\console\Controller;
use common\models\FrontendSetup;
use common\models\Gods;
use yii\base\Exception;
use Yii;
use Intervention\Image\Exception\NotFoundException;
use yii\helpers\ArrayHelper;
use common\models\XmlDate;

class XmlController extends Controller
{

    public function actionParser()
    {
       $selectDocument=XmlDate::find()->where(['date'=>date('W',time())])->all();
        $selectDocument=!empty($selectDocument)?ArrayHelper::getColumn($selectDocument,'id_xml'):0;

        $url_xml = FrontendSetup::find()
            ->select(['id','vaelye'])
            ->where(['description' => 'url'])
            ->andFilterWhere(['not in','id',$selectDocument])
            ->one();
        if(empty($url_xml->vaelye))
            return 'для обновлений слишком рано';

        preg_match("%\/\/((\w*)((\W*)*(\w*)))%", $url_xml->vaelye, $mathes);
        if(empty($mathes))
            preg_match("/https:\/\/((\w*)((\W*)*(\w*)))/", $url_xml->vaelye, $mathes);
        if(strpos($mathes[0],'#'))
        {
            $expl=explode('#',$mathes[0]);
            $url=$expl[0];
        }else{
            $url=$mathes[0];
        }
        $goods=Gods::find()->andWhere(['like', 'url', $url])->all();
        $currency = ArrayHelper::map(FrontendSetup::find()->where(['description' => 'currency'])->asArray()->all(),
            'key_setup', 'vaelye');
        $goodsArr=[];
        $xml=$this->XmlFile($url_xml->vaelye);
        foreach ($goods as $onegoods){

            if(empty($onegoods->pluss))
                break;
            $arrGoods['url']=$onegoods->url;
            $arrGoods['pluss']=$onegoods->pluss;
            $arrGoods['id']=$onegoods->id; //todo изменить на id товара
            $arrGoods['price']=$onegoods->price;  // todo измпенить на price товара
            $goodsArr[]=$arrGoods;
        }

        $have =  $this->getXmlTrue($xml, $currency);

        $priceArr=$this->priceArr($goodsArr,$have);

        $saveHave=array_keys($have);

        $notHave=$this->getXmlFalse($goodsArr,$saveHave);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->saveAll($priceArr);
            $this->saveNotHave($saveHave,$mathes[1]);
            $this->saveHave($saveHave);
            $this->saveXmlDate($url_xml);
            $frontendSetup=new FrontendSetup([
                    'key_setup'=>'Дата',
                    'vaelye'=>(string)time(),
                    'description'=>'dataXMLParser'
                ]);
            if(!$frontendSetup->save()){
                var_dump($frontendSetup->errors);
            }
            $transaction->commit();

        } catch (\RuntimeException $ex) {
            $transaction->rollBack();
            return var_dump($ex->getMessage());
        }
    }

    public function saveXmlDate($setupModel){
        $xmlDate=XmlDate::find()->where(['id_xml'=>$setupModel->id])->one();
        if(!$xmlDate){
            $xmlDate=new XmlDate();
            $xmlDate->id_xml=$setupModel->id;
        }
        if(!$xmlDate->save())
            throw new \Exception (print_r($xmlDate->errors,1));
    }

    public function XmlFile($files){
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
        return simplexml_load_file($files);
    }

    public function getXmlTrue($xml, $currency)
    {

        if (is_object($xml)) {
            $result = [];
            foreach ($xml->shop->offers->offer as $offer) {
                if ($offer->attributes()->available == true) {
                    $result[(string)$offer->url] = $offer->price * (int)$currency[(string)$offer->currencyId];
                }
            }
            return $result;
        } else {
            throw new \RuntimeException('не найденно xml');
        }
    }

    public function getXmlFalse($arrGoods,$haves)
    {
        $url=ArrayHelper::getColumn($arrGoods,'url');
        return array_diff($url,$haves);
    }

    private function saveAll($priceArr)
    {
        foreach ($priceArr as $price){
            $goods=Gods::findOne($price['id']);     //todo price  goods
            $goods->price=$price['price'];         // todo price goods
            if(!$goods->save())
                throw new \RuntimeException(print_r($price->errors,1));
        }

    }

    private function priceArr($priceArr,$xmlArr){
        $returnArr=[];
        foreach ($priceArr as $arrPrice){
            if(!array_key_exists('url',$arrPrice))
                continue;

            if(empty($xmlArr[$arrPrice['url']]))
                continue;

            if(
                !isset($arrPrice['price'])||
                ($xmlArr[$arrPrice['url']]+$arrPrice['pluss']>$arrPrice['price'])
            )
            {
                $arr['price']=$xmlArr[$arrPrice['url']]+$arrPrice['pluss'];  //todo price1 изменить на price
                $arr['id']=$arrPrice['id'];
                $returnArr[]=$arr;
            }
        }
        return $returnArr;
    }

    private function saveNotHave($notHave,$like)
    {
        if(empty($notHave))
            return true;
        $url=array_unique($notHave);
        Gods::updateAll(
            ['have'=>Gods::NOT_HAVE],
            ['AND',
                ['not in','url',$url],
                ['like','url',$like]
            ]);

        return true;
    }

    private function saveHave($url){
        if(empty($url))
            return true;
        $url =array_unique($url);
        Gods::updateAll(['have'=>Gods::HAVE],['in','url',$url]);

        return true;
    }
}
