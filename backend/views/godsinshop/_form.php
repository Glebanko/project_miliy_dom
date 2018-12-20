<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\JsExpression;

if(isset($gods)){$theGoods=ArrayHelper::map($gods,'id','title');}
if(isset($shop)){$theShop=ArrayHelper::map($shop,'id','shop_names');}

/* @var $this yii\web\View */
/* @var $model common\models\Godsinshop */
/* @var $form yii\widgets\ActiveForm */
?>

<div  id="colorsData" class="godsinshop-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php
    if(Yii::$app->request->isAjax){
        ?>
        <?= $form->field($model, 'id_gods')->dropDownList($gods)->label(false);?>
        <p class="col-lg-24 col-md-24 col-sm-24 col-xs-24 color">
            <?=$color ?>
        </p>
            <?= $form->field($model,'color')->hiddenInput(['value'=>0])->label(false); ?>
        <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 size">
            <?php
            if(isset($size)){
                echo Select2::widget([
                    'name'=>'size',
                    'data' => $size,
                    'options' => ['placeholder' => Yii::t('frontend','SELECTSIZE')],
                    'pluginOptions' => [
                        'tags' => true,
                    ],
                    'pluginEvents' => [
                        "change" => "function(event) { document.getElementById('basket-size').setAttribute('value',this.value); }",]
                ]);
            } ?>
        </div>
    <?php }elseif($model->isNewRecord){
    if(isset($theGoods)) { ?>
        <?= $form->field($model, 'id_gods')->widget(Select2::classname(), [
            'data' => $theGoods,
            'language' => 'ru',
            'options' => ['multiple' => true,'placeholder' => Yii::t('backend','SELECTGODS'),'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true,
            ],
            'pluginEvents' => [
                "select2:selecting" => 'function(e){
                $.post(
                    "/admin/godsinshop/create",
                    {id: e.params.args.data.id},
                     function (data){$(".wrapper").html(data)}
                )}'
                //'function(e){console.log(e.params.args.data.id)}',
            ],
        ])->label(false);?>
    <?php } else { ?>
       <?= Yii::t('backend','ADDGOODS'); ?>
    <?php } ?>
    <?php }else{}
    if(isset($theShop)){ ?>
        <?= $form->field($model, 'id_shop')->widget(Select2::classname(), [
            'data' => $theShop,
            'language' => 'ru',
            'options' => ['multiple' => true,'placeholder' => Yii::t('backend','SELECTSHOPS'),'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);?>
    <?php } ?>
    <?= $form->field($model, 'quntity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
