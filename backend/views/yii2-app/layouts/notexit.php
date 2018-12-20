<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="container-fluid">
    <div class="row">
        <div class="panel panel-info col-lg-4 col-md-4 col-sm-6 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-1">
            <div class="panel-heading"><?= Yii::t('backend','ERR_EXT_HEAD'); ?></div>
            <div class="panel-body">
                <?= Yii::t('backend','ERROR_EXIT'); ?> <?= Html::a(Yii::t('backend','LINK_ERR_EXT'),Url::to('http://miliydom.com.ua/')); ?>

            </div>
        </div>
    </div>
</div>