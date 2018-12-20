<?php
namespace common\models;
use pastuhov\ymlcatalog\ShopInterface;
use Yii;
/**
 * @inheritdoc
 */
class Shop implements ShopInterface
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
        return Yii::$app->homeUrl;
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
} ?>