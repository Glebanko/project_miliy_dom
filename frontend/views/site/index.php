<?php

/* @var $this yii\web\View */

use frontend\widget\menu\Menu;
use frontend\widget\hit\Hit;
use frontend\widget\newgoods\Newgoods;
use frontend\widget\sell\Sell;

$this->title = 'Главная';
?>


<div class="container-fluid" style="margin: 0px;padding: 0px;">
    <div id="galery-photo" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="/img/image.png" style="width: 100%;">
            </div>
            <div class="item">
                <img src="/img/image.png" style="width: 100%;">
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#galery-photo" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#galery-photo" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>

<div class="container-fluid" style="background: black; margin: 0px;padding: 0px;">
    <div id="category" class="carousel slide" data-ride="carousel" data-interval="false">

        <!-- Wrapper for slides -->
        <div class="carousel-inner carousel-category-bar">
            <div class="item active">
                <div class="category-bar">
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2018/06/krossy.png">
                            <p>Кроссовки</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2016/12/pillow.png">
                            <p>Подушки</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2018/06/dress.png">
                            <p>Платья</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2018/06/sumki.png">
                            <p>Сумки/Клатчи</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2018/06/tufli.png">
                            <p>Туфли женские</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2018/06/kupalniki.png">
                            <p>Пляжная одежда</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2018/06/ochki.png">
                            <p>Очки</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="category-bar">
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2018/06/futbolki.png">
                            <p>Футболки</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2018/06/towel.png">
                            <p>Полотенкца</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2018/06/bad.png">
                            <p>Постельное белье</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2016/12/bijouterie.png">
                            <p>Бижутерия</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2016/12/linens.png">
                            <p>Покрывала</p>
                        </a>
                    </div>
                    <div class="categor">
                        <a href="">
                            <img src="http://miliydom.com.ua/frontend/web/image/frontendImage/carusel/2016/12/mattresses.png">
                            <p>Матрасы</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#category" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#category" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>
<div class="container" style="padding-top: 0px;">
    <div class="hit">
        <div class="name-hit">
            <h3>ХИТЫ ПРОДАЖ</h3>
            <a href="">ПЕРЕЙТИ КО ВСЕМ</a>
        </div>
        <div class="goods-hit">
            <div id="hit-goods" class="carousel slide" data-ride="carousel" data-interval="false">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?= Hit::widget();?>
                </div>

                <!-- Controls -->
                <a class="left left-control" href="#hit-goods" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right right-control" href="#hit-goods" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container" style="padding-top: 0px;">
    <div class="hit">
        <div class="name-hit">
            <h3>НОВИНКИ</h3>
            <a href="">ПЕРЕЙТИ КО ВСЕМ</a>
        </div>
        <div class="goods-new">
            <div id="new-goods" class="carousel slide" data-ride="carousel" data-interval="false">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?= Newgoods::widget();?>
                </div>

                <!-- Controls -->
                <a class="left left-control" href="#new-goods" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right right-control" href="#new-goods" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container" style="padding-top: 0px;">
    <div class="hit">
        <div class="name-hit">
            <h3>РАСПРОДАЖА</h3>
            <a href="">ПЕРЕЙТИ КО ВСЕМ</a>
        </div>
        <div class="goods-new">
            <div id="sell-goods" class="carousel slide" data-ride="carousel" data-interval="false">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?= Sell::widget();?>
                </div>

                <!-- Controls -->
                <a class="left left-control" href="#sell-goods" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right right-control" href="#sell-goods" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>



