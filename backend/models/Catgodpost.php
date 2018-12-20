<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_cat_gods_post".
 *
 * @property integer $id
 * @property integer $id_cat
 * @property integer $id_gods
 * @property integer $id_post
 */
class Catgodpost extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_cat_gods_post';
    }

    public function saveCat($id_cat,$id_goods){
        if(is_array($id_cat)){
            foreach ($id_cat as $cat_id){
                $arrCatGods=Catgodpost::findOne(['id_cat'=>$cat_id,'id_gods'=>$id_goods]);
                if(!isset($arrCatGods)){
                    $catGods= new Catgodpost([
                        'id_cat'=>$cat_id,
                        'id_gods'=>$id_goods
                    ]);
                    $catGods->save();
                }
            }
            $allCatArr=Catgodpost::find()->where(['id_gods'=>$id_goods])->andWhere(['not in','id_cat',$id_cat])->all();
            foreach ($allCatArr as $delCat){
                $delCat->delete();
            }
        }else{
            $arrCatGods=Catgodpost::findOne(['id_cat'=>$id_cat,'id_gods'=>$id_goods]);
            if(!isset($arrCatGods)){
                $catGods= new Catgodpost([
                    'id_cat'=>$id_cat,
                    'id_gods'=>$id_goods
                ]);
                $catGods->save();
            }
        }

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cat'], 'required'],
            [['id_cat', 'id_gods', 'id_post'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cat' => 'Id Cat',
            'id_gods' => 'Id Gods',
            'id_post' => 'Id Post',
        ];
    }

    public function addCatGods($cat){
        $category = Category::findOne(['name'=>$cat->kat]);
        $theFind=Catgodpost::findOne(['id_cat'=>$category->id,'id_gods'=>$cat->id]);
        if(empty($theFind)) {
            $catgods = new Catgodpost([
                'id_cat' => $category->id,
                'id_gods' => $cat->id
            ]);
            $catgods->save();
        }
    }
}
