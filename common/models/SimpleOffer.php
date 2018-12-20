<?php
namespace common\models;
use common\models\Gods;
use pastuhov\ymlcatalog\SimpleOfferInterface;
use yii\db\ActiveRecord;
use Yii;
/**
 * @inheritdoc
 */
class SimpleOffer extends ActiveRecord implements SimpleOfferInterface
{


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->attributes['id'];//$this->gods->id;
    }
    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        $gods=Gods::findOne($this->attributes['id']);
        if(is_object($gods->category)) {
            return "http://miliydom.com.ua/" . $gods->category->slug_category . '/' . $gods->slug_gods;
        }else{
            return "http://miliydom.com.ua/";
        }
    }
    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        $gods=Gods::findOne($this->attributes['id']);
        return $gods->prise->price1;
    }
    /**
     * @inheritdoc
     */
    public function getOldPrice()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getCurrencyId()
    {
        return 'UAH';
    }
    /**
     * @inheritdoc
     */
    public function getCategoryId()
    {
        $gods=Gods::findOne($this->attributes['id']);
        if(is_object($gods->category)){
            return $gods->category->id;
        }else{
            return $gods->id;
        }

    }
    /**
     * @inheritdoc
     */
    public function getMarket_Category()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getPictures()
    {
        $gods=Gods::findOne($this->attributes['id']);
        $result = [];
        if(isset($gods->images)) {
            $pictures = $gods->images;
            foreach ($pictures as $picture) {
                $result[] = 'http://miliydom.com.ua/frontend/web/image/' . $picture->path . '' . $picture->name;
            }
        }
        return $result;
    }
    /**
     * @inheritdoc
     */
    public function getStore()
    {
        return true;
    }
    /**
     * @inheritdoc
     */
    public function getPickup()
    {
        return true;
    }
    /**
     * @inheritdoc
     */
    public function getDelivery()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getLocal_Delivery_Cost()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getName()
    {
        $gods=Gods::findOne($this->attributes['id']);
        return strip_tags(htmlspecialchars_decode($gods->title));
    }
    /**
     * @inheritdoc
     */
    public function getVendor()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getVendorCode()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        $gods=Gods::findOne($this->attributes['id']);
        return strip_tags(htmlspecialchars_decode($gods->discription_gods));
    }
    /**
     * @inheritdoc
     */
    public function getSales_notes()
    {
        return 'Необходима предоплата';
    }
    /**
     * @inheritdoc
     */
    public function getManufacturer_Warranty()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getCountry_Of_Origin()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getAdult()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getAge()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getBarcode()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getCpa()
    {
        return null;
    }
    /**
     * @inheritdoc
     */
    public function getParams()
    {
        return [];
    }
    /**
     * @inheritdoc
     */
    public static function findYml($findParams = [])
    {
        $query = self::find();
        $query->orderBy('id');
        if (isset ($findParams['excluded'])) {
            $query->andWhere(['not in', 'id', $findParams['excluded']]);
        }
        return $query;
    }
    public static function tableName()
    {
        return 'abh_gods';
    }
    /**
     * @inheritdoc
     */
    public function getBid()
    {
        return 13;
    }
    /**
     * @inheritdoc
     */
    public function getCbid()
    {
        return 20;
    }
    /**
     * @inheritdoc
     */
    public function getAvailable()
    {
        if (isset($this->attributes['is_available'])) {
            return 'true';
        }
        return 'false';
    }
    /**
     * @inheritdoc
     */
    public function getDeliveryOptions()
    {
        $result = [];
        // если id товарного предложения равен 12, то для теста возвращаем пустой массив опций
        if($this->getId() != 12) {
            $options = [
                [
                    'cost' => 123,
                    'days' => '2'
                ],
                [
                    'cost' => 100,
                    'days' => '1'
                ],
            ];
            foreach($options as $option) {
                $deliveryOption = new DeliveryOption();
                $deliveryOption->cost = $option['cost'];
                $deliveryOption->days = $option['days'];
                $result[] = $deliveryOption;
            }
        }
        return $result;
    }
}?>