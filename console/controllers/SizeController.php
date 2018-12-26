<?php
namespace console\controllers;

use common\models\Addlfeild;
use common\models\FrontendSetup;
use yii\console\Controller;

class SizeController extends Controller
{
    public function actionSizedel(){
        $addFields=Addlfeild::find()->all();
        $goodsArr='\n\r';
        foreach ($addFields as $addField){
            if(isset($addField->goods->categorys)){
                if($addField->goods->categorys->size=='Одежда'){
                    if($addField->key_feild=='size1'&&empty($addField->frontendSetup)){
                        $frontSet= new FrontendSetup([
                            'key_setup'=>$addField->value,
                            'vaelye'=>$addField->value,
                            'description'=>'size',
                        ]);
                        $frontSet->save();
                        unset($frontSet);
                    }
                }
            }
        }
        
    }
}