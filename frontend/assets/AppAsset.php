<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        'https://fonts.googleapis.com/css?family=Ubuntu',
        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.1/css/bootstrap-slider.min.css',
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.1/bootstrap-slider.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
