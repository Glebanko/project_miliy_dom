<?php

namespace backend\modules\prom;

use Yii;
use yii\base\InvalidConfigException;
use yii\caching\Cache;
use backend\modules\prom\models\promShop;
use backend\modules\prom\behaviors\PromOfferBehavior;
use backend\modules\prom\behaviors\PromCategoryBehavior;

/**
 * prom module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\prom\controllers';

    /** @var int */
    public $cacheExpire = 86400;

    /** @var Cache|string */
    public $cacheProvider = 'cache';

    /** @var string */
    public $cacheKey = 'YandexMarketYml';

    /** @var boolean Use php's gzip compressing. */
    public $enableGzip = false;

    /** @var PromCategoryBehavior */
    public $categoryPromModel;

    /** @var array */
    public $offerPromModels;

    /** @var array */
    public $shopOptions = [];

    public function init()
    {
        parent::init();

        if (is_string($this->cacheProvider)) {
            $this->cacheProvider = Yii::$app->{$this->cacheProvider};
        }

        if (!$this->cacheProvider instanceof Cache) {
            throw new InvalidConfigException('Invalid `cacheKey` parameter was specified.');
        }
    }
    public function buildYml()
    {
        $shop = new promShop();
        $shop->attributes = $this->shopOptions;
        $categoryModel = new $this->categoryPromModel;
        $shop->categories = $categoryModel->generatePromCategories();

        foreach ($this->offerPromModels as $modelName) {
            /** @var PromOfferBehavior $model */
            if (is_array($modelName)) {
                $model = new $modelName['class'];
            } else {
                $model = new $modelName;
            }

            $shop->offers = array_merge($shop->offers, $model->generatePromOffers());
        }

        if (!$shop->validate()) {
            return $this->createControllerByID('default')->renderPartial('errors', [
                'shop' => $shop,
            ]);
        }

        $ymlData = $this->createControllerByID('default')->renderPartial('index', [
            'shop' => $shop,
        ]);
        $this->cacheProvider->set($this->cacheKey, $ymlData, $this->cacheExpire);

        return $ymlData;
    }
}
