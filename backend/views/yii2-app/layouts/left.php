<?php
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;
?>
<aside class="main-sidebar">

    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php
                if(isset(Yii::$app->user->identity->avatar)) { ?>
                    <?= Html::img(Yii::getAlias('@frontendWebroot').'/image/'.Yii::$app->user->identity->avatar,['class'=>"img-circle"]) ?>
                <?php }else{?>
                    <?= Html::img(Yii::getAlias('@frontendWebroot').'/image/frontendImage/noavatar.jpeg',['class'=>"img-circle"]) ?>
                <?php } ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php if (Yii::$app->user->can('fullAdmin')) { ?>
        <?= \dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => Yii::t('app','USER_REDACT'), 'icon' => 'fa fa-users', 'url' => ['/rbac/permission/index']],
                    ['label' => Yii::t('backend','MESSAGE'), 'icon' => 'fa fa-comment', 'url' => ['/message/index']],
                    ['label' => Yii::t('backend','CATEGORY'), 'icon' => 'fa fa-sitemap', 'url' => ['/category/index']],
                    ['label' => Yii::t('app','GODS'), 'icon' => 'fa fa-cart-plus', 'url' => ['/gods/index']],
                    ['label' => Yii::t('backend','PRICE'), 'icon' => 'fa fa fa-money', 'url' => ['/prise/index']],
                    ['label' => Yii::t('backend','POST'), 'icon' => 'fa fa-newspaper-o', 'url' => ['/post/index']],
                    ['label' => Yii::t('backend','COMMMENT'), 'icon' => 'fa fa-commenting', 'url' => ['/comments/index']],
                    ['label' => Yii::t('backend','SHOP'), 'icon' => 'fa fa-university', 'url' => ['/shop/index']],
                    ['label' => Yii::t('backend','SIZESDSETUP'), 'icon' => 'fa fa-wrench', 'url' => ['/sizes/index']],
                    ['label' => Yii::t('backend','CURRENCY'), 'icon' => 'fa fa-files-o', 'url' => ['/currency/index?CurrencySearch[description]=currency']],
                    ['label' => Yii::t('backend','PATERNS'), 'icon' => 'fa fa-files-o', 'url' => ['/patern/index']],
                    ['label' => Yii::t('backend','ALLPRICE'), 'icon' => 'fa fa-usd', 'url' => ['/gods/urlpriceparser']],
                    ['label' => Yii::t('backend','XMLPRICE'), 'icon' => 'fa fa-eur', 'url' => ['/gods/parserprice']],
                    ['label' => Yii::t('backend','PROM'), 'icon' => 'fa fa-yahoo', 'url' => ['/prom-market.yml']],
                    ['label' => Yii::t('backend','YML'), 'icon' => 'fa fa-yahoo', 'url' => ['/yandex-market.yml']],
                    ['label' => Yii::t('backend','FRONTENDSETUP'), 'icon' => 'fa fa-wrench', 'url' => ['/frontendsetup/index']],
                    ['label' => Yii::t('backend','PROVIDERSETUP'), 'icon' => 'fa fa-wrench', 'url' => ['/provider/index?ProviderTableSearch[description]=provider']],
                    ['label' => Yii::t('backend','COLORSETUP'), 'icon' => 'fa fa-wrench', 'url' => ['/color/index?ColorSearch[description]=color']],
                    ['label' => Yii::t('backend','MENUSETUP'), 'icon' => 'fa fa-bars', 'url' => ['/menusetup/index?FrontendSetupSearch[description]=menus']],
                    ['label' => Yii::t('backend','CARUSELMENUSETUP'), 'icon' => 'fa fa-clone', 'url' => ['/caruselmenu/index?FrontendSetupSearch[description]=carmenu']],
                    ['label' => Yii::t('backend','IMAGEFRONTENDSETUP'), 'icon' => 'fa fa-picture-o', 'url' => ['/setupimage/index?FrontendSetupSearch[description]=image']],
                    ['label' => Yii::t('backend','PAGE'), 'icon' => 'fa fa-file-text-o', 'url' => ['/page/index']],
                    ['label' => Yii::t('backend','SLIDER'), 'icon' => 'fa fa-sliders', 'url' => ['/slider/index?FrontendSetupSearch[description]=slider']],
                    ['label' => Yii::t('backend','CURRENCY'), 'icon' => 'fa fa-money', 'url' => ['/currency/index?CurrencySearch[description]=currency']],
                    ['label' => Yii::t('backend','URL'), 'icon' => 'fa fa-wifi', 'url' => ['/urls/index?UrlsSearch[description]=url']],
                    ['label' => Yii::t('backend','SOCIAL'), 'icon' => 'fa fa-comments-o', 'url' => ['/social/index?FrontendSetupSearch[description]=social']],
                    ['label' => Yii::t('backend','CATSETUP'), 'icon' => 'fa fa-bars', 'url' => ['/catsetup/index?FrontendSetupSearch[description]=catsetup']],
                    ['label' => Yii::t('backend','POSTCATEGORY'), 'icon' => 'fa fa-file-word-o', 'url' => ['/postcategory/index?FrontendSetupSearch[description]=postcategory']],
                    ['label' => Yii::t('backend','TABLESIZE'), 'icon' => 'fa fa-file-word-o', 'url' => ['/addtablesize/index?AddtablesizeSearch[description]=tablesize']],
                    ['label' => Yii::t('backend','TABLEDEFAULT'), 'icon' => 'fa fa-file-word-o', 'url' => ['/defaulttable/index?DefaulttableSearch[description]=tableDefault']],
                    ['label' => Yii::t('backend','ORDERS'), 'icon' => 'fa fa-shopping-bag', 'url' => ['/orders/index']],
                    ['label' => Yii::t('backend','IMAGE'), 'icon' => 'fa fa-shopping-bag', 'url' => ['/image/index']],
                    ['label' => Yii::t('backend','CODSINSHOP' ), 'icon' => 'fa fa-sitemap', 'url' => ['/godsinshop/index']],
                    ['label' => Yii::t('backend','CODSINSHOP' ), 'icon' => 'fa fa-sitemap', 'url' => ['/godsinshop/index']],
                    ['label' => Yii::t('backend','SOURCEMESSAGE'), 'icon' => 'fa fa-times', 'url' => ['/translation/transliter/index']],
                    ['label' => Yii::t('backend','SOURCEMESSAGE'), 'icon' => 'fa fa-times', 'url' => ['/menu/menubackend/']],
                ],
            ]
        ) ?>
            <?php echo InputFile::widget([
                'language'   => 'ru',
                'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                'filter'     => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                'name'       => 'myinput',
                'value'      => '',
            ]); ?>
<?php } elseif (Yii::$app->user->can('createNews')) { ?>
    <?= dmstr\widgets\Menu::widget(
        [
            'options' => ['class' => 'sidebar-menu'],
            'items' => [
               ['label' => Yii::t('backend','POST'), 'icon' => 'fa fa-newspaper-o', 'url' => ['/post/index']],
            ],
        ]
    ) ?>
 ?>
<?php } elseif (Yii::$app->user->can('canCreateNews')) { ?>
    <?= dmstr\widgets\Menu::widget(
        [
            'options' => ['class' => 'sidebar-menu'],
            'items' => [
                ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ['label' => Yii::t('app','GODS'), 'icon' => 'fa fa-cart-plus', 'url' => ['/gods/index']],
                ['label' => Yii::t('backend','PAGE'), 'icon' => 'fa fa-file-text-o', 'url' => ['/page/index']],
                ['label' => Yii::t('backend','SLIDER'), 'icon' => 'fa fa-sliders', 'url' => ['/slider/index?FrontendSetupSearch[description]=slider']],
                ['label' => Yii::t('backend','CODSINSHOP' ), 'icon' => 'fa fa-sitemap', 'url' => ['/godsinshop/index']],
                ['label' => Yii::t('backend','ORDERS' ), 'icon' => 'fa fa-shopping-bag', 'url' => ['/orders/index']],
                ['label' => Yii::t('backend','POST'), 'icon' => 'fa fa-newspaper-o', 'url' => ['/post/index']],
            ],
        ]
    ) ?>    
<?php }else{ ?>

            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        ['label' => Yii::t('app','GODS'), 'icon' => 'fa fa-cart-plus', 'url' => ['/gods/index']],
                        ['label' => Yii::t('backend','PAGE'), 'icon' => 'fa fa-file-text-o', 'url' => ['/page/index']],
                        ['label' => Yii::t('backend','SLIDER'), 'icon' => 'fa fa-sliders', 'url' => ['/slider/index?FrontendSetupSearch[description]=slider']],
                        ['label' => Yii::t('backend','CODSINSHOP' ), 'icon' => 'fa fa-sitemap', 'url' => ['/godsinshop/index']],
                    ],
                ]
            ) ?>
<?php } ?>
    </section>
</aside>
