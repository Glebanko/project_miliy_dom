
<?
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>

<?if(isMobile()){echo "";}else{?>
<div class="item <?if(isMobile()){echo"";}else{echo "active";}?> display-none-mobile">
        <div class="goods-settings">
            <? $x = 0; foreach ($categoryGoods as $good){?>
                <?foreach ($good['hit'] as $key => $good){?>
                    <? $x++; if($x == 4){break;}?>
                    <div class="good">
                        <i class="sticker sticker_bestseller"></i>
                        <div class="name">
                            <span><?=$good['title']?></span>
                        </div>
                        <a href="">
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
                                        if(($good['price']['price2'] != null) or ($good['price']['priceEvro'] != null) or ($good['price']['priceSem'] != null)){?>
                                            <span>от </span>
                                        <?}?>
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
                                    <form id="goBasket">
                                        <button type="submit" class="submitButtonBasket">В КОРЗИНУ</button>
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
            <?foreach ($good['hit'] as $key => $good){?>
                <? $x++; if($x < 4){continue;}?>
                <div class="good">
                    <i class="sticker sticker_bestseller		"></i>
                    <div class="name">
                        <span><?=$good['title']?></span>
                    </div>
                    <a href="">
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
                                        if($good['price']['price2'] != null or $good['price']['priceEvro'] != null or $good['price']['priceSem'] != null){?>
                                            <span>от </span>
                                        <?}?>
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
                                <button>В КОРЗИНУ</button>
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
        <? $q = 0; foreach ($good['hit'] as $key => $good){?>
            <div class="item <?if($q == 0){echo "active";} $q++;?> display-none-pc">
                <div class="goods-settings">
                    <div class="good">
                        <i class="sticker sticker_bestseller		"></i>
                        <div class="name">
                            <span><?=$good['title']?></span>
                        </div>
                        <a href="">
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
                                            if($good['price']['price2'] != null or $good['price']['priceEvro'] != null or $good['price']['priceSem'] != null){?>
                                                <span>от </span>
                                            <?}?>
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
                                    <button>В КОРЗИНУ</button>
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
