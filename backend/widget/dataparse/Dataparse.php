<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05.07.17
 * Time: 16:52
 */

namespace backend\widget\dataparse;

use common\models\FrontendSetup;
use yii\base\Widget;
class Dataparse extends Widget
{
    public function init(){
        parent::init();
    }
    public function run(){
        $url = FrontendSetup::find()->where(['description'   =>  'dataUrlParser'])->orderBy(['vaelye'=>SORT_DESC])->limit(1)->one();
        $xml = FrontendSetup::find()->where(['description'   =>  'dataXMLParser'])->orderBy(['vaelye'=>SORT_DESC])->limit(1)->one();
        return $this->render('data',[
            'url'=>$url,
            'xml'=>$xml
        ]);
    }
}