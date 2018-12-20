<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "abh_gods_in_shop".
 *
 * @property integer $id
 * @property integer $id_gods
 * @property integer $id_shop
 * @property integer $color
 * @property integer $size
 * @property integer $quntity
 */
class Godsinshop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_gods_in_shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_gods', 'id_shop','quntity'], 'required'],
            [['id_gods', 'id_shop', 'color', 'size', 'quntity','article'], 'integer'],
        ];
    }

    /**
     * @param array $dirtyAttributes
     */
    public function theGetGods($model){
        $gods=Gods::findOne(['id'=>$model->id_gods]);
        return Html::a($gods->title,Url::to(['/gods/index','GodsSearch[id]'=>$gods->id]));
    }

    /**
     * @param $model
     * @return string
     */
    public function  theGetShop($model){
        $shop=Shop::findOne(['id'=>$model->id_shop]);
        return $shop->shop_names;
    }
    public function  theGetValue($model){
        $value=Addlfeild::findOne(['id'=>$model]);
        if(isset($value)){
            return $value->value;
        }else{
            return false;
        }
    }
    public function getCategory($json){

    }


    public function getcolor($goods){
        $colors = array_filter($goods, function($item) {
            return $item->key_feild == 'color';
        });
        $arrcolor='';
        if(isset($colors)){
            foreach ($colors as $color) {
                $arrcolor.="<span class='fa fa-square fa-4x colorinput' style='color: $color->value' data-color-id='$color->id' data-color='$color->value' ></span>";
            }
        }
        return $arrcolor;
    }
    public function Goods(){
        return $this->hasOne(Gods::tableName(),['id'=>'id_gods']);
    }
    public function getgoods($goods){
        $array=array([$goods->id=>$goods->title]);
        return $array;
    }
    public function getsize($size)
    {
        $sizes = array_filter($size, function ($item) {
            return $item->key_feild == 'size';
        });
        $arrsize = array();
        if (isset($sizes)) {
            $arrsize = ArrayHelper::map($sizes, 'id', 'value');
        }
        return $arrsize;
    }
    public function getHave($model){
        $goods=Godsinshop::find()->where(['id_gods'=>$model->id_gods,'color'=>$model->color,'size'=>$model->size])->all();
        $sum=Godsinshop::find()->where(['id_gods'=>$model->id_gods,'color'=>$model->color,'size'=>$model->size])->sum('quntity');
        $shopid=array();
        foreach ($goods as $good){
            $shopid[]=$good->id_shop;
        }
        if($sum==0){
            return 'Товаров нет в надличии не в одним из магазинов';
        }else{
            $goodsinShop='';
            foreach ($goods as $good) {
                $shop = Shop::findOne(['id' => $good->id_shop]);
               $goodsinShop .= "<p>В магазине ". $shop->shop_names." ".$good->quntity." товаров </p>";
            }
            return $goodsinShop;
        }
    }
    public function getPrise($id){
        $prise=Prise::findOne($id);
        return "<p><strong>розничная</strong> <span>$prise->price1</span></p><p><strong>оптовая</strong> <span>$prise->wholesale</span></p>";
    }
    public function saveModel($post,$size){
        $goods=Gods::find()->where(['id'=>$post['id_gods']])->with('images','addfeilds','categorys','prise')->one();
        $articles= array_filter($goods->addfeilds, function($item) {
            return $item->key_feild == 'article';});
        $article='';
        if(isset($articles)) {
            foreach ($articles as $artle) {
                $article = $artle->id;
            }
        }else{
            $article= null;
        }
        $sites= array_filter($goods->addfeilds, function($item) {
            return $item->key_feild == 'sites';});
        $site='';
        if(isset($sites)) {
            foreach ($sites as $st) {
                $site = $st->id;
            }
        }else{
            $site=null;
        }
        $code_providers = array_filter($goods->addfeilds, function($item) {
            return $item->key_feild == 'code_provider';});
        $code_provider='';
        if(isset($code_providers)) {
            foreach ($code_providers as $codes_provider) {
                $code_provider = $codes_provider->id_gods;
            }
        }else{
            $code_provider=null;
        }
        $link_sites= array_filter($goods->addfeilds, function($item) {
            return $item->key_feild == 'link_site';});
        $link_site='';
        if(isset($link_sites)) {
            foreach ($link_sites as $links_site) {
                $link_site = $links_site->id;
            }
        }else{
            $link_site=null;
        }
        $name_providers= array_filter($goods->addfeilds, function($item) {
            return $item->key_feild == 'name_provider';});
        $name_provider='';
        if(isset($name_providers)) {
            foreach ($name_providers as $names_provider) {
                $name_provider = $names_provider->id;
            }
        }else{
            $name_provider=null;
        }
        $contact_providers= array_filter($goods->addfeilds, function($item) {
            return $item->key_feild == 'contact_provider';});
        $contact_provider='';
        if(isset($contact_providers)) {
            foreach ($contact_providers as $contacts_provider) {
                $contact_provider = $contacts_provider->id;
            }
        }else{
            $contact_provider=null;
        }
        $diliverys= array_filter($goods->addfeilds, function($item) {
            return $item->key_feild == 'delivery';});
        $dilivery='';
        if(isset($diliverys)) {
            foreach ($diliverys as $dlvrs) {
                $dilivery = $dlvrs->id;
            }
        }else{
            $dilivery = null;
        }
        $countrys= array_filter($goods->addfeilds, function($item) {
            return $item->key_feild == 'country';});
        $country='';
        if(isset($countrys)) {
            foreach ($countrys as $cntrs) {
                $country = $cntrs->id;
            }
        }else{
            $country=null;
        }
        $catarr=array();
        foreach ($goods->category as $cat){
            $catarr['id']=$cat->id;
            $catarr['name']=$cat->name;
        }
        $images= array_filter($goods->images, function($item) {
            return $item->forHome == 1;});
        $image='';
        if(isset($images)) {
            foreach ($images as $img) {
                $image = $img->id;
            }
        }else{
            $image=0;
        }
        $keywords= array_filter($goods->addfeilds, function($item) {
            return $item->key_feild == 'keywords';});

        if(isset($keywords)) {
            $keyarr=array();
            foreach ($keywords as $kwrd) {
                $keyarr[] = $kwrd->id;
                $keyword=json_encode($keyarr);
            }
        }else{
            $keyword=null;
        }
        $model= new Godsinshop([
            'id_gods'           =>$goods->id,
            'article'           =>$article,
            'description'       =>$goods->discription_gods,
            'have'              =>$goods->have,
            'site'              =>$site,
            'code_provider'     =>$code_provider,
            'link_site'         =>$link_site,
            'id_prise'          =>$goods->prise->id,
            'id_img'            =>$image,
            'name_provider'     =>$name_provider,
            'contact_provider'  =>$contact_provider,
            'category'          =>json_encode($catarr),
            'keywords'          =>$keyword,
            'id_shop'           =>$post['id_shop'][0],
            'color'             =>$post['color'],
            'size'              =>$size,
            'quntity'           =>$post['quntity'],
            'delivery'          =>$dilivery,
            'country'          =>$country
        ]);
        if($model->save()){
            return 'thetrue';
        }else{
            return $model->getErrors();
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_img'            =>  Yii::t('backend','IMAGEGODSINSHOP'),
            'id_gods'           =>  Yii::t('backend','GODSIDIGODS'),
            'id_shop'           =>  Yii::t('backend','GODSIDSHOP'),
            'color'             =>  Yii::t('backend','COLOR'),
            'size'              =>  Yii::t('backend','SIZE'),
            'quntity'           =>  Yii::t('backend','QUNTITY'),
            'article'           =>  Yii::t('backend','ARTICLE'),
            'description'       =>  Yii::t('backend','DESCRIPTION'),
            'site'              =>  Yii::t('backend','SITEPROVIDER'),
            'code_provider'     =>  Yii::t('backend','CODEPROVIDER'),
            'name_provider'     =>  Yii::t('backend','NAMEPROVIDER'),
            'link_site'         =>  Yii::t('backend','LINKSITE'),
            'id_prise'          =>  Yii::t('backend','IDPRISE'),
            'contact_provider'  =>  Yii::t('backend','CONTACTPROVIDER'),
            'keywords'          =>  Yii::t('backend','KEYWORDS'),
            'category'          =>  Yii::t('backend','CATEGORY')
        ];
    }
}
