<?php

namespace frontend\widget\menu;

use yii\base\Widget;
use common\model\Category;
use yii\helpers\ArrayHelper;
use Yii;
class Menu extends Widget{

    public function run(){
        $categories=Category::find()->all();
        foreach($categories as $category) {
            if (!$category->parrent_category) {
                if(in_array($category->name,Category::$exceptionCat))
                    continue;
                $menuArray[$category->id] = [
                    'slug_category' => $category->slug_category,
                    'name' => $category->name,
                    'child' => $this->categoryChild($categories, $category->id)
                ];
            }
        }

        return $this->render('html',
            [
                'menuArray'=>$menuArray
            ]);
    }

    /**
     * @param $categories
     * @param $parentId
     * @return array
     * @var $categories common/models/Category
     */
    private function categoryChild($categories, $parentId){
        $child=[];
        foreach($categories as $category){
            if($category->parrent_category==$parentId){
                $child[$category->id]=[
                    'slug_category'=>$category->slug_category,
                    'name'=>$category->name
                ];
            }
        }
        return $child;
    }

}

