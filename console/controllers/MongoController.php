<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.10.17
 * Time: 19:58
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\Gods;
use common\models\mongo\Products;


class MongoController extends Controller
{
    /**
     * добавить продукцию
     */
    public function actionProducts(){
        $products=Gods::find()->with('prise','images','category','addfeilds')->all();

        foreach ($products as $goods) {

            $arrayS=array();
            $arrayS['title'] = $goods->title;
            $arrayS['slug'] = $goods->slug_gods;
            $arrayS['discription'] = $goods->discription_gods;
            $arrayS['created_at'] = $goods->create_at;
            $arrayS['upedate_at'] = $goods->upedate_at;
            $arrayS['product_id'] = $goods->id;
            $addArr=array();
            foreach ($goods as $k=>$v){
                if($k!="slug_gods"&&$k!='discription_gods'&&$k!='id'&&$k!='linenes'&&$k!='idlenens'&&$k!='create_at'&&$k!='upedate_at'){
                    $arrayAdd['key']=$k;
                    $arrayAdd['value']=$v;
                    $addArr[]=$arrayAdd;
                }
            }
            foreach ($goods->addfeilds as $addfeild){
                $arrayAdd['key']=$addfeild->key_feild;
                $arrayAdd['value']=$addfeild->value;
                $addArr[]=$arrayAdd;
            }
            $arrayS['addFeild']=$addArr;
            $catId=array();
            $categorySize=array();
            foreach ($goods->category as $category){
                $cat['id']=$category->id;
                $cat['categorySize']=$category->size;
                $cat['name']=$category->name;
                $catId[]=$cat;
                $categorySize[]=$category->size;
            }
            $arrayS['category']=$catId;

            if(is_object($goods->size2)) {
                $sizes = array();
                $sizesTwo = array();

                if (is_object($goods->size1)) {
                    if (in_array('Полуторное', $categorySize))
                        $sizes[] = 'ONE_AND_A_HALF_NOT';
                    else
                        $sizes[] = 'ONE_AND_A_HALF';
                }
                if (isset($goods->size2)) {
                    if (in_array('Полуторное', $categorySize))
                        $sizes[] = 'DOUBLE_SET_NOT';
                    else
                        $sizes[] = 'DOUBLE_SET';

                }
                if (isset($goods->size3)) {
                    if (in_array('Полуторное', $categorySize))
                        $sizes[] = 'EVRO_NOT';
                    else
                        $sizes[] = 'EVRO';

                }
                if (isset($goods->size4)) {
                    if (in_array('Полуторное', $categorySize))
                        $sizes[] = 'FAMILY_NOT';
                    else
                        $sizes[] = 'FAMILY';
                }
                $arrayS['linesSize']=$sizes;
            }

            $imageCount=0;
            $imageArr=array();
            foreach ($goods->images as $image){
                if($image->forHome ==1){
                    $images['type']='forHome';
                    $images['name']=$image->name;
                    $images['path']=$image->path;
                }else if($image->forFancy ==1){
                    $images['type']='forFancy';
                    $images['name']=$image->name;
                    $images['path']=$image->path.$image->name;
                }else{
                    $images['type']='outher';
                    $images['name']=$image->name;
                    $images['path']=$image->path;
                }
                $imageArr[]=$images;
            }
            $price=array();
            if($goods->prise){
                foreach ($goods->prise as $key =>$val){
                    $price[$key]=$val;
                }
            }
            $arrayS['price']=$price;
            $arrayS['image']=$imageArr;
            unset($imageCount);
            if(is_object($goods->linesall)){
                $linesArr=array();
                foreach ($goods->linesall as $k=>$v){
                    $lines['name']=$k;
                    $lines['value']=$v;
                    $linesArr[]=$lines;
                }
                $arrayS['lines']=$linesArr;
            }
            //return var_dump($arrayS);
            $products=new Products($arrayS);
            $products->insert();
            unset($products);
        }
    }
   

    public  function  actionDelete(){
        $goods=Gods::find()->all();
        foreach ($goods as $good){
            if(isset($good)){
                $products=AllProducts::findOne(['goodsId'=>$good->id]);
                if($products)
                    $products->delete();
            }
        }
    }
}