<?php
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?if(Yii::$app->user->isGuest){?>
<div class="container basket-container">
	<div class="table-responsive" style="max-width: 100%; overflow: auto;">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ФОТО</th> 
					<th>НАЗВАНИЕ</th>
					<th>КОЛИЧЕСТВО</th>
					<th>ЦЕНА</th>
					<th>ЦВЕТ</th>
					<th>РАЗМЕР</th>
					<th>УДАЛИТЬ</th>
				</tr>
			</thead>
			<tbody>
				<? foreach ($goods as $good){?>
					<?
						$prices[] = $good['price']['price1'];
						$prices[] = $good['price']['price2'];
						$prices[] = $good['price']['priceEvro'];
						$prices[] = $good['price']['priceSem'];
						$numberSize = array_search($goodsToCookie, array_column($good['size'], 'value'));
						foreach ($prices as $price) {
							if($price == 0 or $price == null){
								$countPrice++;
							}
						}
						if ($countPrice >= 3) {
							$priceResult = $prices[0];
						}else{
							$priceResult = $prices[$numberSize];
						}
					?>
					<tr class="goodsLine">
						<td>
							<?foreach ($good['image'] as $image){?>
								<?if($image['forHome'] == 1){?>
									<img src="http://miliydom.com.ua/frontend/web/image/<?=$image['path'] . $image['name']?>" width="50">
								<?}?>
							<?}?>
						</td>
						<td style="width: 309px;"><p><?=$good['title']?></p></td>
						<td>
							<div class="basket-quantity">
								<button class="basket basketPlus"><i class="fas fa-plus"></i></button>
								<input type="text" class="quantity" value="1" disabled>
								<button class="basket basketMinus"><i class="fas fa-minus"></i></button>
								<input type="hidden" class="theSumm" value="<?echo $priceResult;?>">
							</div>
						</td>
						<td class="summ">
							<span class="summa">
								<?
									echo $priceResult;
									unset($countPrice);
                    				unset($prices);
                    				unset($priceResult);
								?>
                            </span>
                            <br>
                            <span>
                                грн
                            </span>
						</td>
						<td>
							<?php foreach ($goodsToCookie as $cookie){?>
								<?if($cookie['idGoods'] == $good['id']){?>
									<?if($cookie['color'] != 'Не указан' and $cookie['color'] != null){?>
										<i class="fas fa-square" style="font-size: 40px; color:<?echo $cookie['color'];?>;"></i>
									<?}else{?>
										<p>Не указан</p>
									<?}?>
								<?}?>
							<?}?>
						</td>
						<td style="width: 275px;">
						<?
							foreach ($goodsToCookie as $goodsCookie) {
								if($goodsCookie['idGoods'] == $good['id']){
									echo $goodsCookie['size'];
								}
							}
						?>
						</td>
						<td>
							<form action="deletebasketform" method="post">

								<input type="hidden" name="keyGoods" value="<?$idGoods = $good['id'];$count = array_search($idGoods, $goodsId);echo $count;?>">
								<input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
								<button class="delete-basket">
									<i class="fas fa-times"></i>
								</button>
							</form>
						</td>
					</tr>
				<?}?>
			</tbody>
		</table>
	</div>
	<div class="result-block">
		<p>Итого: <span class="resultSumm"></span> грн.</p>
		<button type="button" class="buttonBuyBasket" data-toggle="modal" data-target="#myModal">Заказать</button>
	</div>
</div>
<?}else{?>	
	<div class="container basket-container">
	<div class="table-responsive" style="max-width: 100%; overflow: auto;">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ФОТО</th> 
					<th>НАЗВАНИЕ</th>
					<th>КОЛИЧЕСТВО</th>
					<th>ЦЕНА</th>
					<th>ЦВЕТ</th>
					<th>РАЗМЕР</th>
					<th>УДАЛИТЬ</th>
				</tr>
			</thead>
			<tbody>
				<? foreach ($goods as $good){?>
					<?
						$prices[] = $good['goods']['price']['price1'];
						$prices[] = $good['goods']['price']['price2'];
						$prices[] = $good['goods']['price']['priceEvro'];
						$prices[] = $good['goods']['price']['priceSem'];
						$numberSize = array_search($good['size'], array_column($good['goods']['size'], 'value'));
						foreach ($prices as $price) {
							if($price == 0 or $price == null){
								$countPrice++;
							}
						}
						if ($countPrice >= 3) {
							$priceResult = $prices[0];
						}else{
							$priceResult = $prices[$numberSize];
						}
					?>
					<tr class="goodsLine">
						<td>
							<?foreach ($good['goods']['image'] as $image){?>
								<?if($image['forHome'] == 1){?>
									<img src="http://miliydom.com.ua/frontend/web/image/<?=$image['path'] . $image['name']?>" width="50">
								<?}?>
							<?}?>
						</td>
						<td style="width: 309px;"><p><?=$good['goods']['title']?></p></td>
						<td>
							<div class="basket-quantity">
								<button class="basket basketPlus"><i class="fas fa-plus"></i></button>
								<input type="text" class="quantity" value="1" disabled >
								<button class="basket basketMinus"><i class="fas fa-minus"></i></button>
								<input type="hidden" class="theSumm" value="<?echo $priceResult;?>">
							</div>
						</td>
						<td class="summ">
							<span class="summa">
								<?
									echo $priceResult;
									unset($countPrice);
                    				unset($prices);
                    				unset($priceResult);
								?>
                            </span>
                            <br>
                            <span>
                                грн
                            </span>
						</td>
						<td>
						<?if($good['color'] != 'Не указан' and $good['color'] != null){?>
							<i class="fas fa-square" style="font-size: 40px; color:<?echo $good['color'];?>;"></i>
						<?}else{?>
							<p>Не указан</p>
						<?}?>
						</td>
						<td style="width: 275px;">
						<?if($good['size'] != 'Не указан' and $good['size'] != null){
							echo $good['size'];
						}else{?>
							<p>Не указан</p>
						<?}?>
						</td>
						<td>
							<form action="deletebasketform" method="post">
								<input type="hidden" name="idGoods" value="<?=$good['goods']['id']?>">
								<input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
								<button class="delete-basket">
									<i class="fas fa-times"></i>
								</button>
							</form>
						</td>
					</tr>
				<?}?>
			</tbody>
		</table>
	</div>
	<div class="result-block">
		<p>Итого: <span class="resultSumm"></span> грн.</p>
		<button type="button" class="buttonBuyBasket" data-toggle="modal" data-target="#myModal">Заказать</button>
	</div>
</div>
<?}?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Оформления заказа</h4>
      </div>
      <?php 
      Pjax::begin();
      $form = ActiveForm::begin([
      	'options' => ['id' => 'basketForm', 'data' => ['pjax' => true]],
      	'action' => '/basketrequest', 
      ]);?>
	      <div class="modal-body">
	        <p style="opacity: 0.6;">Для оформления заказа заполните, пожалуйста, форму приведенную ниже. Поля отмеченные звездочкой - обязательны к заполнению.</p>
		        <div style="width: 265px;">
			        <?= $form->field($model, 'name')?>
			        <?= $form->field($model, 'surname')?>
			        <?= $form->field($model, 'email')?>
			        <?= $form->field($model, 'phone')?>
			        <?= $form->field($model, 'city')?>
			        <?= $form->field($model, 'deliveryAddress')?>
			        <?= $form->field($model, 'postOffice')?>
			        <?= $form->field($model, 'comments')?>
		        </div>
	      </div>
      <div class="modal-footer">
      	
      	<button class="btn btn-success">Отправить</button>
      </div>
      <?php 
      ActiveForm::end();
      Pjax::end();
      ?>
    </div>
  </div>
</div>1