<?php

namespace backend\modules\prom\controllers;

use Yii;
use yii\web\Controller;
use backend\modules\prom\Module;

/**
 * @author Corpsepk
 * @package corpsepk\yml
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        /** @var Module $module */
        $module = $this->module;

        /*if (!$ymlData = $module->cacheProvider->get($module->cacheKey)) {*/
            $ymlData = $module->buildYml();
        /*}*/

       Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/xml');
        if ($module->enableGzip) {
            $ymlData = gzencode($ymlData);
            $headers->add('Content-Encoding', 'gzip');
            $headers->add('Content-Length', strlen($ymlData));
        }
        return $ymlData;
    }
}
