<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28.09.17
 * Time: 18:45
 */

namespace console\controllers;

use yii\console\Controller;

use common\models\Gods;
use common\models\FrontendSetup;
use yii\helpers\Json;

class UrlController extends Controller
{
    use \common\traits\UrlTrait;

    public function actionParser(){
        $goods=Gods::find()->where(['not',['Pregmath'=>null]])->andWhere(['not',['Pregmath'=>'']])->with('prise')->all();
        $firstArray=array();
        foreach ($goods as $good){
            $firstArray['goods'][$good->id]['url']=$good->url;
            $firstArray['goods'][$good->id]['id_price']=$good->id_prise;
            $firstArray['goods'][$good->id]['pattern']=$good->pregmath;
            $firstArray['goods'][$good->id]['id']=$good->id;
            $firstArray['price'][$good->id_prise]=$this->getPrice($good->prise);
        }
        $frontEndSetup=FrontendSetup::findOne(['key_setup'=>'first_array','description'=>'urlparser']);
        if($frontEndSetup){
            $frontEndSetup->vaelye=Json::encode($firstArray);
        }else{
            $frontEndSetup=new FrontendSetup([
                'key_setup'=>'first_array',
                'vaelye'=>Json::encode($firstArray),
                'description'=>'urlparser'
            ]);
        }

        if(!$frontEndSetup->save()){
            return var_dump($frontEndSetup->getErrors());
        }
    }
    public function actionGetpage(){
        $json=FrontendSetup::findOne(['key_setup'=>'first_array','description'=>'urlparser']);
        $firstArray=Json::decode($json->vaelye,$asArray = false);
        foreach ($firstArray->goods as $array){
            $pageArray[]=$this->getArrPrice($array->url,$array->pattern);
        }
        return var_dump($pageArray);
    }
    

    
}