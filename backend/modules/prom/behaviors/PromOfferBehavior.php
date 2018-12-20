<?php
/**
 * @link https://github.com/corpsepk/yii2-yandex-market-yml
 * @copyright Copyright (c) 2016 Corpsepk
 * @license http://opensource.org/licenses/MIT
 */

namespace backend\modules\prom\behaviors;

use yii\base\Behavior;
use yii\base\InvalidConfigException;
use common\models\Gods;

/**
 * YmlOffer Behavior for YandexMarketYml Yii2 module.
 * @see https://yandex.ru/support/webmaster/goods-prices/technical-requirements.xml
 *
 * For example:
 *
 * ```php
 * public function behaviors()
 * {
 *  return [
 *       'ymlOffer' => [
 *           'class' => YmlOfferBehavior::className(),
 *           'scope' => function ($model) {
 *               /* @var \yii\db\ActiveQuery $model *\/
 *               $model->select(['id', 'name', 'parent_id']);
 *               $model->andWhere(['>', 'in_stock', 0]);
 *               $model->andWhere(['is_deleted' => 0]);
 *           },
 *           'dataClosure' => function ($model) {
 *              /** @var self $model *\/
 *              return new \corpsepk\yml\models\Offer([
 *                  'id' => $model->id,
 *                  'url' => $model->getUrl(),
 *                  'price' => $model->getPrice(),
 *                  'currencyId' => 'RUR',
 *                  'categoryId' => $model->catgory_id,
 *                  'picture' => $model->cover ? $model->cover->getUrl('1500x') : null,
 *                  'name' => $model->name,
 *                  'vendor' => $model->brand ? $model->brand->name : null,
 *                  ...
 *              ]);
 *          }
 *       ],
 *  ];
 * }
 * ```
 *
 * @author Corpsepk
 * @package corpsepk\yml
 */
class PromOfferBehavior extends Behavior
{
    const BATCH_MAX_SIZE = 100;

    /** @var callable */
    public $dataPromClosure;

    /** @var callable */
    public $scopeProm;

    public function init()
    {
        if (!is_callable($this->dataPromClosure)) {
            throw new InvalidConfigException('PromCategoryBehavior::$dataPromClosure isn\'t callable.');
        }
    }

    public function generatePromOffers()
    {
        $result = [];

        /** @var \yii\db\ActiveRecord $owner */
        $owner = $this->owner;
        $query = $owner::find()->where(['not_prom'=>Gods::PROM_YES]);
        if (is_callable($this->scopeProm)) {
            call_user_func($this->scopeProm, $query);
        }

        foreach ($query->each(self::BATCH_MAX_SIZE) as $model) {
            $data = call_user_func($this->dataPromClosure, $model);

            if (empty($data)) {
                continue;
            }
            $result[] = $data;
        }
        return $result;
    }
}
