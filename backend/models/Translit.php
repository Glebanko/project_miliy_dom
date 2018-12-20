<?php
namespace backend\models;


use yii\base\Model;
use dosamigos\transliterator\TransliteratorHelper;

class Translit extends Model{
    public function traranslitImg($img){
        $strArr = array('/', '\\', ',', '<', '>', '"', "ь", "ъ",'&',);
        $slugimmage = str_replace($strArr, '', $img);
        $slugimg = str_replace(' ', '-', $slugimmage);
        $filenames=TransliteratorHelper::process($slugimg, '', 'en');
        return $filenames;
    }
    public function traranslitSlug($slugs){
        $strArr = array('/', '\\', ',', '\'','<', '>', '"', "ь", "ъ",'+','&','@','#','$','%','^','&','*','(',')','!','?','/','>','<','<<','>>','«','»','"','`');
        $theSlug = explode('(', $slugs);
        $slugTitle = str_replace($strArr, '', $theSlug[0]);
        $slug = str_replace(' ', '-', $slugTitle);
        $filenames=TransliteratorHelper::process($slug, '', 'en');
        return $filenames;
    }

}
