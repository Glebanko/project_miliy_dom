
<?if(isMobile()){echo "";}else{?>
    <div class="item <?if(isMobile()){echo"";}else{echo "active";}?> display-none-mobile">
        <div class="goods-settings">
            <? $x = 0; foreach ($categoryGoods as $good){?>
                <?foreach ($good['sell'] as $key => $good){?>
                    <? $x++; if($x == 4){break;}?>
                    <?if($good['price']['price1'] != 0){
                        $summ = $good['price']['price1'];
                    }
                    if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                        $summ = $good['price']['price2'];
                    }
                    if(($good['price']['price1'] == 0) or ($good['price']['price2'] == 0 && null)){
                        $summ = $good['price']['priceEvro'];
                    }
                    if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                        $summ = $good['price']['priceSem'];
                    }?>
                    <div class="good">
                        <i class="sticker_right sticker_sell">
                            <?
                                $sell = $good['price_selling'];
                                $result_sell = $sell / $summ * 100;
                                echo '-' . round($result_sell) . '%';
                            ?>
                        </i>
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
                                    <span>
                                        <?if($good['price']['price1'] != 0){
                                            echo $good['price']['price1'];
                                        }
                                        if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                                            echo $good['price']['price2'];
                                        }
                                        if(($good['price']['price1'] == 0) or ($good['price']['price2'] == 0 && null)){
                                            echo $good['price']['priceEvro'];
                                        }
                                        if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                                            echo $good['price']['priceSem'];
                                        }?>
                                        <sup>
                                            грн
                                        </sup>
                                    </span>
                                    <form class="goBasket">
                                        <button class="submitButtonBasket">В КОРЗИНУ</button>
                                        <input type="hidden" name="id" value="<?echo $good['id'];?>">
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
            <? }?>
        </div>
    </div>
    <div class="item display-none-mobile">
        <div class="goods-settings">
            <? $x = 0; foreach ($categoryGoods as $good){?>
                <?foreach ($good['sell'] as $key => $good){?>
                    <? $x++; if($x < 4){continue;}?>
                    <? $x++; if($x == 4){break;}?>
                    <?if($good['price']['price1'] != 0){
                        $summ = $good['price']['price1'];
                    }
                    if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                        $summ = $good['price']['price2'];
                    }
                    if(($good['price']['price1'] == 0) or ($good['price']['price2'] == 0 && null)){
                        $summ = $good['price']['priceEvro'];
                    }
                    if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                        $summ = $good['price']['priceSem'];
                    }?>
                    <div class="good">
                        <i class="sticker_right sticker_sell">
                            <?
                            $sell = $good['price_selling'];
                            $result_sell = $sell / $summ * 100;
                            echo '-' . round($result_sell) . '%';
                            ?>
                        </i>
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
                                    <span>
                                        <?if($good['price']['price1'] != 0){
                                            echo $good['price']['price1'];
                                        }
                                        if($good['price']['price1'] == 0 or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                                            echo $good['price']['price2'];
                                        }
                                        if(($good['price']['price1'] == 0) or ($good['price']['price2'] == 0 && null)){
                                            echo $good['price']['priceEvro'];
                                        }
                                        if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                                            echo $good['price']['priceSem'];
                                        }?>
                                        <sup>
                                            грн
                                        </sup>
                                    </span>
                                    <form class="goBasket">
                                        <button class="submitButtonBasket">В КОРЗИНУ</button>
                                        <input type="hidden" name="id" value="<?echo $good['id'];?>">
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
            <? }?>
        </div>
    </div>
<? }?>
<?if(isMobile()){?>
    <?foreach ($categoryGoods as $good){?>
        <? $q = 0; foreach ($good['sell'] as $key => $good){?>
            <div class="item <?if($q == 0){echo "active";} $q++;?> display-none-pc">
                <div class="goods-settings">
                    <? $x++; if($x == 4){break;}?>
                    <?if($good['price']['price1'] != 0){
                        $summ = $good['price']['price1'];
                    }
                    if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                        $summ = $good['price']['price2'];
                    }
                    if(($good['price']['price1'] == 0) or ($good['price']['price2'] == 0 && null)){
                        $summ = $good['price']['priceEvro'];
                    }
                    if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                        $summ = $good['price']['priceSem'];
                    }?>
                    <div class="good">
                        <i class="sticker_right sticker_sell">
                            <?
                            $sell = $good['price_selling'];
                            $result_sell = $sell / $summ * 100;
                            echo '-' . round($result_sell) . '%';
                            ?>
                        </i>
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
                                        <span>
                                            <?if($good['price']['price1'] != 0){
                                                echo $good['price']['price1'];
                                            }
                                            if($good['price']['price1'] == 0 or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                                                echo $good['price']['price2'];
                                            }
                                            if(($good['price']['price1'] == 0) or ($good['price']['price2'] == 0 && null)){
                                                echo $good['price']['priceEvro'];
                                            }
                                            if(($good['price']['price1'] == 0) or ($good['price']['price2'] ==  0 && null) or ($good['price']['priceEvro'] == 0 && null)){
                                                echo $good['price']['priceSem'];
                                            }?>
                                            <sup>
                                                грн
                                            </sup>
                                        </span>
                                    <form class="goBasket">
                                        <button class="submitButtonBasket">В КОРЗИНУ</button>
                                        <input type="hidden" name="id" value="<?echo $good['id'];?>">
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
                </div>
            </div>
        <? }?>
    <? }?>
<? }?>
