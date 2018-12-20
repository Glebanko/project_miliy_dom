<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-shopping-bag"></i>
    <span class="label label-danger"><?=$count?></span>
</a>
<ul class="dropdown-menu">
    <li class="header"><?= Yii::t('backend','NOTRSELL')?> <?=$count?></li>
    <li>
        <!-- inner menu: contains the actual data -->
        <ul class="menu">
            <?php foreach ($orders as $order){ ?>
            <li><!-- start message -->
                <a href="<?= Yii::$app->urlManager->createUrl(['/orders/index','OrdersSearch[id]'=>$order->id]); ?>">
                    <h3>
                        <?= Yii::t('backend','NEWORDER') ?>
                        <small><i class="fa fa-clock-o"></i><?= date('d-m-Y H:i')?></small>
                    </h3>
                    <h3><?= Yii::t('backend','ORDERSELL') ?></h3>
                    <?php foreach ($order->baskets as $baskets){ ?>
                        <div class="pull-left">
                            <?php $img = array_filter($baskets->gods->images, function($item) {
                                return $item->forHome == 1;
                            });
                            if(isset($img)){
                                foreach($img as $image){

                                    echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . 'avatar-' . $image->name, ['alt' => $baskets->gods->title,'class'=>'img-circle','width'=>40]);}
                            }
                            ?>
                        </div>
                        <p><?= $baskets->gods->title ?></p>
                    <?php } ?>
                </a>
            </li>
            <?php } ?>

        </ul>
    </li>
    <li class="footer">
        <?= Html::a(Yii::t('backend','VIEWALLTASKS'),Url::to(['/orders/index','OrdersSearch[received_sell]'=>0]))?>
    </li>
</ul>
