<?php

namespace common\models;

use Yii;
use backend\models\Translit;
use yii\helpers\Html;
use sirgalas\menu\behaviors\MenuBaseWordpressBehavior;
/**
 * This is the model class for table "abh_frontendSrtup".
 *
 * @property integer $id
 * @property integer $key_setup
 * @property integer $vaelye
 * @property string $description
 */
class FrontendSetup extends \yii\db\ActiveRecord
{
    public $menus;
    public $pages;
    public $goodsid;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_frontendSetup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key_setup', 'vaelye'], 'required'],
            [['key_setup'], 'string', 'max' => 510],
             [['vaelye'], 'string'],
            [['description'], 'string', 'max' => 500],
        ];
    }

    public function behaviors()
    {
        return [
            'BaseMenu' => [
                'class'             =>  MenuBaseWordpressBehavior::className(),
                'nameModel'         =>  '\common\models\FrontendSetup',
                'dbName'            =>  'abh_frontendSetup',
                'idBehavior'        =>  'id',
                'name'              =>  'key_setup',
                'content'           =>  'vaelye',
                'serviceField'      =>  'description',
                'nameServiceField'  =>  'menus'
            ],
        ];
    }
    public function parentLines($goods){
        $array=array();
        foreach ($goods->addfeilds as $addfields){
                if($addfields->key_feild=='size1'){
                    $array['goods']['size1']=$addfields->value;
                }
                if($addfields->key_feild=='size2'){
                    $array['goods']['size2']=$addfields->value;
                }
                if($addfields->key_feild=='size3'){
                    $array['goods']['size3']=$addfields->value;
                }
                if($addfields->key_feild=='size4'){
                    $array['goods']['size4']=$addfields->value;
                }

                if($addfields->key_feild=='size5'){
                    $array['goods']['size5']=$addfields->value;
                }
                if($addfields->key_feild=='size6'){
                    $array['goods']['size6']=$addfields->value;
                }
        }
        foreach ($goods->linesall->sheets->addfeilds as $addfields) {
            $array['sheets']['priseSheet']=$goods->linesall->sheets->id_prise;
            if ($addfields->key_feild == 'size1') {
                $array['sheets']['size1'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size2') {
                $array['sheets']['size2'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size3') {
                $array['sheets']['size3'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size4') {
                $array['sheets']['size4'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size5') {
                $array['sheets']['size5'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size6') {
                $array['sheets']['size6'] = $addfields->value;
            }
        }
        foreach ($goods->linesall->pillowcases->addfeilds as $addfields) {
            $array['pillowcases']['prisePillowcases']=$goods->linesall->pillowcases->id_prise;
            if ($addfields->key_feild == 'size1') {
                $array['pillowcases']['size1'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size2') {
                $array['pillowcases']['size2'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size3') {
                $array['pillowcases']['size3'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size4') {
                $array['pillowcases']['size4'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size5') {
                $array['pillowcases']['size5'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size6') {
                $array['pillowcases']['size6'] = $addfields->value;
            }
        }
        foreach ($goods->linesall->duvetscover->addfeilds as $addfields) {
            $array['duvetscover']['priseDuvetscover']=$goods->linesall->duvetscover->id_prise;
            if ($addfields->key_feild == 'size1') {
                $array['duvetscover']['size1'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size2') {
                $array['duvetscover']['size2'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size3') {
                $array['duvetscover']['size3'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size4') {
                $array['duvetscover']['size4'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size5') {
                $array['duvetscover']['size5'] = $addfields->value;
            }
            if ($addfields->key_feild == 'size6') {
                $array['duvetscover']['size6'] = $addfields->value;
            }
        }
        return $array;
    }

    public function  catsetup($value,$basepath){
        $val=explode(',%,',$value);
        $arr= array();
        foreach ($val as $json){
            if($json != '') {
                if(preg_match('%image-%',$json)){
                    $img = str_replace('image-', '', $json);
                    $arr['path'] = $basepath . '' . $img;
                }
                if(preg_match('%text-%',$json)){
                    $text=str_replace('text-','',$json);
                    $arr['text']=$text;
                }
                if(preg_match('%id-%',$json)) {
                    $id = str_replace('id-', '', $json);
                    $arr['id'] = $id;
                    $goods=Category::findOne($id);
                    $arr['slug']=$goods->slug_category;
                }
            }

        }
        return json_encode($arr, JSON_FORCE_OBJECT);
    }

    public function imageSlider($value,$basepath){
        $val=explode(',%,',$value);
        $jsonarr=array();
        $counter=0;
        foreach ($val as $json){
            $arr= array();
            $img='';
            $name='';
            if($json != ''){
                if(preg_match('%left-%',$json)){
                    $name='left';
                    $img=str_replace('left-','',$json);
                    $arr['path']=$basepath.''.$img;
                }
                if(preg_match('%center-%',$json)){
                    $name='center';
                    $img=str_replace('center-','',$json);
                    $arr['path']=$basepath.''.$img;
                }
                if(preg_match('%right-%',$json)){
                    $name='right';
                    $img=str_replace('right-','',$json);
                    $arr['path']=$basepath.''.$img;
                }
                if(preg_match('%back-%',$json)){
                    $name='background';
                    $img=str_replace('back-','',$json);
                    $arr['path']=$basepath.''.$img;
                    $jsonarr[$name]=$arr;
                }
                if(preg_match('%text-%',$json)){
                    $name='text';
                    $text=str_replace('text-','',$json);
                    $arr['text']=$text;
                }
                $arr['name']=$name;
                $jsonarr[$counter]=$arr;
                $counter=$counter+1;
            }
        }
        return json_encode($jsonarr, JSON_FORCE_OBJECT);
    }

    public function imageBaseSave($name,$key,$description){
        $transliterator= new Translit();
        $stringTosave=array();
        if(preg_match('/,%,/',$name)){
            $mathes=explode(',%,',$name);
            $i=0;
            foreach ($mathes as $math){
                $names=$transliterator->traranslitImg($math);
                $jsonchild='"path":"frontendImage/","name":"'.$names.'"';
                $stringTosave.='{"image":{'.$jsonchild.'}}';
                $i= $i+1;
            }
        }else{

            $names=$transliterator->traranslitImg($name);
            $jsonchild='"path":"frontendImage/","name":"'.$names.'"';
            $stringTosave ='{"image":{'.$jsonchild.'}}';
        }
        $newImage= new FrontendSetup([
            'key_setup'=>$key,
            'vaelye'=>$stringTosave,
            'description'=>$description
        ]);
        $newImage->save();
        return $name;
    }

     public function addForCar($works){
        $arrRes=array();
        foreach ($works as $work){
            $item  = "<div class='item'><a href='".Yii::$app->urlManager->createUrl(["/gods/gods/category",'slug'=>$work->cat->slug_category])."'>";
            $item .= "<span class='theImg'>".Html::img(Yii::getAlias($work->vaelye))."</span >";
            $item .="<span class='col-lg-24'>$work->key_setup</span></a></div>";
            $arrRes[]=$item;
        }
        return $arrRes;
    }

    /**
     * @return int
     */
    public function getValuePrice($id)
    {
        $prise=Prise::findOne($id);
        return $prise->sites;
    }
    
    public function getGoogs(){
        return $this->hasMany(Gods::className(),['id'=>'id_gods'])->viaTable('abh_addlfeild', ['value' => 'key_setup']);
    }

     public function getCat(){
        return $this->hasOne(Category::className(),['name'=>'key_setup']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key_setup' => Yii::t('backend','KEY_SETUP'),
            'vaelye'    => Yii::t('backend','VALUE'),
            'description' => Yii::t('backend','FSDESCRIPTION'),
        ];
    }
}
