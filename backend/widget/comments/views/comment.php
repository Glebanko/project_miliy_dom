<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-commenting"></i>
    <span class="label label-warning"><?= $count ?></span>
</a>
<ul class="dropdown-menu">
    <li class="header"><?= Yii::t('backend','LAST_CONEMT') ?></li>
    <li>
        <ul class="menu">
            <?php foreach ($models as $model){ ?>
            <li>
                <a href="<?= Yii::$app->urlManager->createUrl(['/comments/index',['CommentsSearch[id]'=>$model->id]]); ?>">
                    <div class="pull-left">
                        <?= Html::img(Yii::getAlias('@frontendWebroot/image/').$model->user->avatar,['class'=>'img-circle','width'=>40]);?>
                    </div>
                    <h4>
                        <?=$model->user->username;?>
                    <small><?= date('d:m:Y',$model->created_at) ?></small>
                        <p><?= $model->title; ?></p>
                    </h4>
                </a>
            </li>
            <?php } ?>
        </ul>
    </li>
    <li class="footer"><?= Html::a('Смотреть все ',Url::to(['/comments/index'])); ?></li>
</ul>
