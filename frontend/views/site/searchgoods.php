<!--
<pre>
    <?print_r($goods);?>
</pre>
-->
<div class="goods container" >
<? foreach ($goods as $good){?>
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
                        <a href=""><button>В КОРЗИНУ</button></a>
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





