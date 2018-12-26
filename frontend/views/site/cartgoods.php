<?
	$prices[] = $good['price']['price1'];
	$prices[] = $good['price']['price2'];
	$prices[] = $good['price']['priceEvro'];
	$prices[] = $good['price']['priceSem'];
	$resultPrices = array_shift($prices);
	//print_r($good);
?>
<div class="container">
	<div class="col-md-6">
		<div>
			<div class="block-cartgoods">
				<div class="slider-cartgoods">	
						<?foreach ($good['image'] as $image) {?>
							<?if($image['forHome'] == 0){?>
				  				<div style=""><a data-fancybox="goods-photo-<?=$good['id']?>" href="http://miliydom.com.ua/frontend/web/image/<?=$image['path'] . $image['name']?>"><img src="http://miliydom.com.ua/frontend/web/image/<?=$image['path'] . $image['name']?>" alt="" height="400px" class="img-cartgoods"></a></div>
							<?}?>
				  		<?}?>
				</div>
			</div>
			<div class="info">
				<p>ТОВАР НА ФОТО МОЖЕТ ОТЛИЧАТЬСЯ ОТ ОРИГИНАЛА: возможно незначительное отличие товара от фотографии по оттенку (яркость, тон или насыщенность, а не глобально другой цвет), связанное с разной яркостью и настройками монитора, студийной съемкой, обработкой фотографии в графических редакторах.</p>
			</div>
		</div>	
	</div>
	<div class="col-md-6">
		<div class="name-cartgoods">
			<h1><?=$good['title']?></h1>
		</div>
		<div class="price">
			<h2>Цена: <?echo $resultPrices;?> грн.</h2>
		</div>
		<div class="article">
			<h4>Артикул: <?=$good['article']['article']?></h4>
		</div>
		<div class="color">
			<?foreach ($good['color'] as $color) {?>
				<i class="fas fa-square youColor" style="color: <?=$color['color']?>;"></i>
			<?}?>
		</div>
		<div class="select-size">
			<select class="form-control select-sizes">
				<option value="Размер не выбран" selected disabled hidden>Выберите размер</option>
				<?foreach ($good['size'] as $size) {?>
					<option value="<?=$size['value']?>"><?=$size['value']?></option>
				<?}?>
			</select>
		</div>
		<div class="table-size">
			<a href="http://miliydom.com.ua/frontend/web/image/tablesize/2017/10/0-02-05-4ca1395124440bf50f48f9e7fb2ca0f45fbe2e870bad8cd9d7053f8e1866c60f_full.jpg" data-fancybox="table-size"><h3>Таблица размеров</h3></a>
		</div>
		<div class="buy-button">
			<form class="goCartgoods">
				<button><i class="fas fa-cart-plus"></i>Купить</button>
				<input type="hidden" name="id" value="<?=$good['id']?>">
				<input type="hidden" name="color" class="cartgoods-color" value="Не указан">
				<input type="hidden" name="size" class="cartgoods-size" value="Не указан">
				<input type="hidden" name="price" value="<?echo $resultPrices;?>">
			</form>
		</div>
		<div class="description">
			<h2>Описание товара</h2>
			<?=$good['discription_gods']?>
			<p><span>Страна производитель:</span> <?=$good['info'][0]['value']?></p>
			<p><span>Состав:</span> <?=$good['info'][1]['value']?></p>
			<p><span>Доставка:</span> <?=$good['info'][2]['value']?></p>
			<p><span>Размеры:</span> 
				<?
				$count = count($good['size']);
                $t = 0;
				foreach ($good['size'] as $keySize => $size){
                    $t++;
                    if($t == $count){ echo $size['value'];}else{echo $size['value'] . ", ";}
                }?>
            </p>
			<p>Сделать заказ на сайте miliydom очень просто - нажмите на кнопку купить и оформите заказ, наши специалисты свяжутся с Вами.</p>
		</div>
	</div>
</div>