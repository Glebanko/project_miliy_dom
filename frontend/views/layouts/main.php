<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widget\menu\Menu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<div class="wrap">
<?php $this->beginBody() ?>
<div class="menu-user container-fluid">
    <div class="container">
        <div class="col-md-3 menu-left">
            <a>Контакты</a>
            <a>Доставка</a>
        </div>
        <div class="col-md-6 menu-center">
            <a href="tel:38 (050) 220-29-60">+38 (050) 220-29-60</a>
            <a href="tel:38 (097) 448-52-87">+38 (097) 448-52-87</a>
            <a href="tel:38 (073) 153-55-43">+38 (073) 153-55-43</a>
        </div>
        <div class="col-md-3 menu-right">
            <?php
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
            } else {
                echo "<a href='/profile'>Профиль</a>";
                $menuItems[] = '<a>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Выход', /*(' . Yii::$app->user->identity->username . ')*/
                        ['class' => 'btn btn-link logout lagout-button']
                    )
                    . Html::endForm()
                    . '</a>';
            }
            if(Yii::$app->user->isGuest){
                foreach($menuItems as $menu){
                    echo "<a href='{$menu['url'][0]}'>{$menu["label"]}</a>";
                }
            }else{
                foreach($menuItems as $menu){
                    echo $menu;
                }
            }
            ?>
        </div>
    </div>
</div>
    <div class="menu-basic container-fluid" style="background: white;">
        <div class="container">
            <div class="col-md-5 menu-basic-left no-display-max-width">
                <i class="fas fa-search"></i>
                <div class="search">
                    <form action="searchgoods" method="post">
                        <input type="text" name="goods" placeholder="Поиск">
                          <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
                    </form>
                </div>
            </div>
            <div class="col-md-2 menu-basic-center">
                <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/logo.png" alt="" />
            </div>
            <div class="col-md-5 menu-basic-right no-display-max-width">
                <a href="/cart/cart/index" style="color: black; margin-right: 5px;">
                    <span id="amount-basket"></span> 
                    вещь(ей)
                 </a>
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="col-md-12 menu-basic-left no-display-min-width">
                <i class="fas fa-search"></i>
                <--?= Search::widget(); ?>
            </div>
        </div>
    </div>

    <div class="menu container-fluid display-none-mobile">
        <div class="container">
            <? echo Menu::widget(); ?>
        </div>
    </div>
    <div class="display-none-pc">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="menu-basic-right navbar-brand no-display-min-width" style="float: left; display: flex;">
                <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                <a style="color: black;"><span><--?= Countcart::widget();?></span> вещь(ей)</a>
            </div>
            <a class="navbar-brand" style="color: black;">Меню</a>
        </div>


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <--?= Menumobile::widget();?>
        </div>
    </div>
<?= Breadcrumbs::widget([
    'homeLink' => ['label' => 'Магазин "Милый дом"', 'url' => '/'],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>
    <div id="overlay" class="cover blur-in">
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
<script>
    $(function () {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 176) {
                $(".nav-toggle-main").css({position: "fixed", top: "0", left: "0px"});

            } else {
                $(".nav-toggle-main").css({position: "absolute", top: "176px"});

            }
        });
        // With JQuery
        $("#ex2").slider({});
    });
</script>
<?if(!Yii::$app->user->isGuest){?>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: "/amountgoods",
                success: function(html){
                    $('#amount-basket').html(html);
                }
            });
        });
        $('.submitButtonBasket').click(function(){
            $.ajax({
                url: "/amountgoods",
                success: function(html){
                    $('#amount-basket').html(html);
                }
            });
        });
        $("#goBasket").submit(function(){
            var id = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "gobasket",
                data: id,
                success: function(){
                    console.log('Есть!');
                }
            });
            return false;
        });
    </script>
    <?}?>
</body>
</html>
<?php $this->endPage() ?>
