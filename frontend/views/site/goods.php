<!--
   Скрытый checkbox, отвечающий за переключение панели, должен быть в верхней части документа, лучше сразу после тега `<body>`

   `id` атрибут предназначен для связки с атрибутом `for` тега <label>

   Атрибут `hidden` указывает состояние «скрытый» у текущего элемента
   -->
<input type="checkbox" id="nav-toggle" hidden="">
<!--
Выдвижную панель размещаете ниже
флажка (checkbox), но не обязательно
непосредственно после него, например
можно и в конце страницы
-->
<nav class="nav">
    <!--
Метка с именем `id` чекбокса в `for` атрибуте
Символ Unicode 'TRIGRAM FOR HEAVEN' (U+2630)
Пустой атрибут `onclick` используем для исправления бага в iOS < 6.0
См: http://timpietrusky.com/advanced-checkbox-hack
-->
    <label for="nav-toggle" class="nav-toggle" onclick=""></label>
<!--
Здесь размещаете любую разметку,
если это меню, то скорее всего неупорядоченный список <ul>
-->
    <h2 class="logo">
        <a href="#">Фильтр</a>
    </h2>
    <div class="sort">
        <div class="price-sort">
            <p>Сортировать по цене</p>
            <select name="" id="" class="form-control">
                <option disabled selected>Выберите сортировку</option>
                <option value="">По уменьшению</option>
                <option value="">По возрастанию</option>
            </select>
            <div class="polzun-price">
                <b>0 грн</b> <input id="ex2" type="text" class="span2" value="" data-slider-min="0" data-slider-max="28800" data-slider-step="100" data-slider-value="[0,28800]"/> <b>28800 грн</b>
            </div>
        </div>
        <form action="filter" method="get">
            <div class="category-sort">
                <p>По категориям</p>
                <? foreach ($goods['parent'] as $parent){?>
                    <div class="blockCheckBox">
                        <input type="checkbox" name="sortCategory" value="<?=$parent['slug_category']?>">
                        <label for="sortCategory"><?=$parent['name']?></label>
                    </div>
                <?}?>
            </div>
            <input type="submit" value="Приминить">
        </form>
    </div>
</nav>

<div class="mask-content"><label for="nav-toggle" onclick="" style="width: 100%;height: 100%;"></label></div>

<div style="">
    <label for="nav-toggle" class="nav-toggle-main" onclick=""></label>
</div>
<div class="goods container" >
<? foreach ($goods['goods'] as $good){?>
    <?
        $prices[] = $good['price']['price1'];
        $prices[] = $good['price']['price2'];
        $prices[] = $good['price']['priceEvro'];
        $prices[] = $good['price']['priceSem'];
        $resultPrices = array_shift($prices);
    ?>
        <div class="good">
                        <i class="sticker sticker_bestseller"></i>
                        <div class="name">
                            <span><?=$good['title']?></span>
                        </div>
                        <a href="/cartgoods/<? echo $good['slug_gods'];?>">
                            <div class="img">
                                <img src="http://miliydom.com.ua/frontend/web/image/<? foreach ($good['image'] as $keyImage => $image){?><?if($image['forHome'] == 1){$i++;?><?=$image['path'] . $image['name']?><?}?><?}?>" alt="">
                                <span>Артикул: <?=$good['article']['article']?></span>
                            </div>
                        </a>
                        <div class="action">
                            <div class="LikePriceBuy">
                                <div class="like">
                                    <a href="">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </div>
                                <div class="priceBuy">
                                    <span><?
                                            $title = explode(" ", $good['title']);
                                            if($title[0] == "Постельное" or $title[0] == "Плед"){?>
                                                <span>от </span>
                                            <?}?>
                                        <?
                                        echo $resultPrices;
                                        unset($title);
                                        ?>
                                        <sup>
                                            грн
                                        </sup>
                                    </span>
                                <form class="goBasket">
                                    <button class="submitButtonBasket">В КОРЗИНУ</button>
                                    <input type="hidden" name="id" value="<?echo $good['id'];?>">
                                    <input type="hidden" name="price" value="<? echo $resultPrices;?>">
                                    <?
                                    unset($resultPrices);
                                    unset($prices);
                                    ?>
                                </form>
                            </div>
                            </div>
                            <div class="size">
                                <span>
                                    <?
                                        $count = count($good['size']);
                                        $t = 0;
                                        if(!$count == null){echo "Размер: ";}else{echo "Размер: не указан";}
                                        if(strpos($good['title'], 'Постельное белье') == 'Постельное белье'){
                                            $f = 0;
                                            foreach ($good['size'] as $keySize => $size){
                                                if($size['key_feild'] == 'size1'){
                                                    echo "полуторный"; $f++; if($f == $count){ echo "";}else{echo ", ";}
                                                }
                                                if($size['key_feild'] == 'size2'){
                                                    echo "двойной"; $f++; if($f == $count){ echo "";}else{echo ", ";}
                                                }
                                                if($size['key_feild'] == 'size3'){
                                                    echo "евро"; $f++; if($f == $count){ echo "";}else{echo ", ";}
                                                }
                                                if($size['key_feild'] == 'size4'){
                                                    echo "семейка"; $f++; if($f == $count){ echo "";}else{echo ", ";}
                                                }
                                            }
                                        }else{
                                             foreach ($good['size'] as $keySize => $size){
                                                 $t++;
                                                  if($t == $count){ echo $size['value'];}else{echo $size['value'] . ", ";}

                                             }
                                        }

                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
<? }?>
</div>





