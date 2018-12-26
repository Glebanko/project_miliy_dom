<?php
namespace console\controllers;

use pastuhov\ymlcatalog\actions\GenerateAction;
use yii\console\Controller;

/**
 * Class GenerateController
 */
class YmlController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'generate' => [
                'class' => GenerateAction::className(),
                'enableGzip' => true, # запаковать gzip-ом yml после генерации
                'fileName' => 'yml-test.xml', # желаемое название файла
                'publicPath' => '@frontend/web', # публичная директория (обычно корень веб сервера)
                'runtimePath' => '@runtime', # временная директория
                'keepBoth' => true, # опубликовать yml и .gz
                'shopClass' => 'common\models\Shop',
                'currencyClass' => 'common\models\Currency',
                'categoryClass' => 'common\models\Category',
                'localDeliveryCostClass' => 'common\models\LocalDeliveryCost',
                'offerClasses' => [
                    'common\models\SimpleOffer'
                ],
            ],
        ];
    }
}