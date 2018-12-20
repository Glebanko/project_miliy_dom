<?php
/**
 *  * @property string $addFeild
 */

namespace common\models\mongo;

use common\models\Addlfeild;
use yii\base\Model;
use yii\mongodb\ActiveRecord;
use yii2tech\embedded\ContainerTrait;
use yii2tech\embedded\ContainerInterface;
use common\models\mongo\AddFeild;
use common\models\mongo\Category;
use common\models\mongo\Image;
use common\models\mongo\Lines;
class ProductsAll  extends \yii2tech\embedded\mongodb\ActiveRecord implements ContainerInterface
{
    use ContainerTrait;
 
    public static function collectionName()
    
    {
        return 'product';
    }
    public function attributes()
    {
        return ['_id','title', 'slug','product_id', 'article','discription','created_at','upedate_at','addFeild','category','image','lines'];
    }


    public function embedAddFeild()
    {
        return $this->mapEmbedded('addFeild', \common\models\mongo\AddFeild::className());
    }
    public function embedCategory()
    {
        return $this->mapEmbedded('category', \common\models\mongo\Category::className());
    }
    public function embedImage()
    {
        return $this->mapEmbedded('image', \common\models\mongo\Image::className());
    }
    public function embedLines()
    {
        return $this->mapEmbedded('lines', \common\models\mongo\Lines::className());
    }

}