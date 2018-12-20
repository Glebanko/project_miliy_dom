<?php

namespace common\models;

use pastuhov\ymlcatalog\ShopInterface;
use Yii;

/**
 * This is the model class for table "abh_shop".
 *
 * @property integer $id
 * @property string $adress
 * @property string $shop_names
 */
class Shop extends \yii\db\ActiveRecord implements ShopInterface
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Милый дом';
    }
    /**
     * @inheritdoc
     */
    public function getCompany()
    {
        return 'Интернет-магазин Милый Дом - большой выбор постельного белья по доступным ценам, полотенец для всей семьи, а также мужской и женской одежды по самым низким ценам';
    }
    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return Yii::$app->basePath;
    }
    /**
     * @inheritdoc
     */
    public function getPlatform()
    {
        return 'Yii 2';
    }
    /**
     * @inheritdoc
     */
    public function getVersion()
    {
        return '2.3';
    }
    /**
     * @inheritdoc
     */
    public function getAgency()
    {
        return 'Agency';
    }
    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return 'CMS@CMS.ru';
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
    public static function tableName()
    {
        return 'abh_shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_names'], 'required'],
            [['adress'], 'string', 'max' => 610],
            [['shop_names'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'adress' => 'Adress',
            'shop_names' => 'Shop Names',
        ];
    }
}
