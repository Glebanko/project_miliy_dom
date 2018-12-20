<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\Gods */
/* @var $form yii\widgets\ActiveForm */

//$allPrise=ArrayHelper::map($allPrice,'id','price1');
/*if(isset($onePrice)) {
    $onePrise = ArrayHelper::map($onePrice, 'id', 'name');
}*/

$allcat=ArrayHelper::map($categorys,'id','name');

?>

<div class="gods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if(Yii::$app->user->can('canViewsSite')){
        echo $form->field($model, 'slug_gods')->textInput(['maxlength' => true]);
        } ?>
    <?php  if($model->isNewRecord){ ?>
    <?php if(isset($image)){ ?>
        <?= Html::a(Html::img(Yii::getAlias('@frontendWebroot/image/').$image->path.'/'.$image->path), Url::to(['/image/update', 'id' => $image->id])) ?>
    <?php } ?>

    <?=$form->field($model, 'image')->hiddenInput(/*['value'=>'0']*/)->label(false); ?>
    <?php } ?>
    <?php if(Yii::$app->user->can('canViewsSite')){ ?>
    <?=$form->field($model,'url')->textInput(['maxlength'=>true]) ?>
    <?=$form->field($model,'pregmath')->textInput(['maxlength'=>true]) ?>
    <?=$form->field($model,'pluss')->textInput(['maxlength'=>true]) ?>
    <?= $form->field($model, 'manufacturer_price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput(); ?>
    <?php } ?>
    <?= $form->field($model, 'discription_gods')->widget(CKEditor::className(), [
        'options' => [
            'rows' => 6,
        'clientOptions'=>[
                'forcePasteAsPlainText' => true,
                'pasteFilter' => 'plain-text'
            ]
        ],
        'preset' => 'full',

    ]) ?>
    <?php if($model->isNewRecord){
        $model->currency = 80; ?>
        <div class="form-group field-gods-discription_gods required">
            <label class="control-label" for="w4"><?= Yii::t('backend','CURRENCY'); ?></label>
            <?=$form->field($model, 'currency')->widget(Select2::classname(), [
                'data' => $currency,
                'language' => 'ru',
                'options' => ['placeholder' => Yii::t('backend','SELECTCUR')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false); ?>
        </div>
        <div class="form-group field-gods-discription_gods required">
            <label class="control-label" for="w3"><?= Yii::t('backend','CATEGORY'); ?></label>
            <?= $form->field($catgods, 'id')->widget(Select2::classname(), [
                'data' => $allcat,
                'language' => 'ru',
                'options' => ['multiple' => true,'placeholder' => Yii::t('backend','SELECTGODS')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false); ?>
        </div>
        <div class="form-group field-gods-discription_gods required">
            <label class="control-label" for="w4"><?= Yii::t('backend','SELECTSIZE'); ?></label>
            <?= $form->field($model, 'size')->widget(Select2::classname(), [
                'data' => $sizeInSelect,
                'language' => 'ru',
                'options' => ['multiple' => true,'placeholder' => Yii::t('backend','SELECTSIZE')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false); ?>
        </div>
        <div class="form-group field-gods-discription_gods required">
            <label class="control-label" for="w4"><?= Yii::t('backend','SELECTCOLOR'); ?></label>
            <?= $form->field($model, 'colors')->widget(Select2::classname(), [
                'data' => $colorInSelect,
                'language' => 'ru',
                'options' => ['multiple' => true,'placeholder' => Yii::t('backend','SELECTCOLOR')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false); ?>
        </div>
    <?php }else{
        if(isset($model->category)){
            $multycats=array();
            foreach ($model->category as $cat){
                if(is_object($cat)){
                    $multycats[]=$cat->id;
                }else{
                    $multycats=$model->categorys;
                }
            }
        } ?>
    <div class="form-group field-gods-discription_gods required">
        <label class="control-label" for="w3"><?= Yii::t('backend','CATEGORY'); ?></label>
        <?= Select2::widget([
            'name'=>'id',
            'value' => $multycats,
            'data' => $allcat,
            'options' => ['multiple' => true],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);?>
    </div>
    <div class="form-group field-gods-discription_gods required">
        <label class="control-label" for="w4"><?= Yii::t('backend','CURRENCY'); ?></label>
    <?= Select2::widget([
            'name'=>'Gods[currency]',
            'value' => $model->currency,
            'data' => $currency,
            'pluginOptions' => [
                'tags' => true,
            ],
        ]); ?>
        <?php
        if(is_object($model->categorys)){
         if($model->categorys->size!="Постельное"&&$model->categorys->size!="Полуторное"){
            $arrSize=array();
            foreach ($model->size1 as $sizes){
                if(is_object($sizes->frontendSetup))
                $arrSize[]=$sizes->frontendSetup->id;
            } ?>
        </div>
            <div class="form-group field-gods-discription_gods required">
                 <label class="control-label" for="w4"><?= Yii::t('backend','SELECTSIZE'); ?></label>
             <?= Select2::widget([
                    'name'=>'Gods[size]',
                    'value' => $arrSize,
                    'data' => $sizeInSelect,
                    'options' => ['multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                    ],
                ]);?>
        <?php }
        }
        ?>
    </div>
    <div class="form-group field-gods-discription_gods required">
         <label class="control-label" for="w4"><?= Yii::t('backend','SELECTCOLOR'); ?></label>
        <?php  $arrColor=array();
        $sizeArr=array_filter($model->addfeilds,function($item) {
            return $item->key_feild == 'color';
        });
        foreach ($sizeArr as $colors){
            $arrColor[$colors->id]=$colors->value;
        }
        ?>
     <?= Select2::widget([
            'name'=>'Gods[colors]',
            'value' => $arrColor,
            'data' => $colorInSelect,
            'options' => ['multiple' => true],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
     }?>
    </div>
    <?= $form->field($model, 'have')->dropDownList($model::$haveName);?>
    <?= $form->field($model, 'price_selling')->textInput() ?>
    <?php
    if(isset($onePrice)){
        echo Select2::widget([
            'name'=>'Gods[id_prise]',
            'value' => $onePrice->id,
            'data' => $allPrice,
            'options' => ['placeholder' => Yii::t('backend','ADDPRICE'),],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
    }else {
        echo $form->field($model, 'id_prise')->widget(Select2::classname(), [
            'data' => $allPrice,
            'language' => 'ru',
            'options' => ['placeholder' => Yii::t('backend', 'ADDPRICE')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    }?>
    <?= $form->field($model, 'not_prom')->widget(Select2::classname(), [
            'data' => $model::$promStatus,
            'language' => 'ru',
            'options' => ['placeholder' => Yii::t('backend', 'NOTPROM')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <?= $form->field($model,'linens')->checkbox(['value'=>1]); ?>
    <?= $form->field($model,'viewsTS')->checkbox(['value'=>1]); ?>
    <?= $form->field($model,'table_size')->dropDownList($tablesize,['prompt'=>Yii::t('backend','SelectTable')]); ?>
    <?= $form->field($model,'create_at')->hiddenInput(['value'=>time()])->label(false);?>
    <?= $form->field($model,'alt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
