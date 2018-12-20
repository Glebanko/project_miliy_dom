<?php
/**
 *  * @property string $addFeild
 */

namespace common\models\mongo;
use common\models\Category;
use yii\mongodb\ActiveRecord;
use yii2tech\embedded\ContainerInterface;
use yii2tech\embedded\ContainerTrait;

class Products  extends ActiveRecord
{

    public static function collectionName()

    {
        return 'product';
    }
    public function attributes()
    {
        return ['_id','title', 'slug','product_id', 'article','discription','created_at','upedate_at','addFeild','category','image','lines','price','linesSize'];
    }
    /*public function getCategorys(){
        return $this->hasMany(Category::className(),['id'=>])
    }*/

    public function getDocument($document,$name,$type) {
        
        foreach ($document as $doc) {
            if ($doc[$type] === $name) {
                return $doc;
            }
        }
        return null;
    }
}