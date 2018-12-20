<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frontend-setup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key_setup')->hiddenInput(['value'=>'lines'])->label(false) ?>

    <?= $form->field($model, 'vaelye')->hiddenInput(['value' => ''])->label(false) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label(Yii::t('backend','PATERNS_TITLE')) ?>
    <div id="accordion">
        <h3><a href="#"><?= Yii::t('backend','COMMONDITY')?></a></h3>
        <div>
            <p>
                <?php echo $form->field($model, 'goodsid')->widget(Select2::classname(), [
                    'data' => $gods,
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('backend','SELECTGODS')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'pluginEvents' => [
                        "change" => "function(e) {
                         document.getElementById('frontendsetup-vaelye').value=e.type;
                         }",
                    ],
                ])->label(false);
                ?>
            </p>
        </div>
        <h3><a href="#"><?= Yii::t('backend','HANDMADE')?></a></h3>
        <div>
            <p>
                <div class="blocks">
                    <h3><?= Yii::t('backend','GOODS'); ?><span id="pluss_sheet"  class="fa fa-minus-circle" ></span></h3>
                    <div id="goods" class="inner">
                        <div class="form-group field-frontendsetup-description">
                            <label for="size1" class="control-label"><?= Yii::t('backend','SIZE1')?></label>
                            <input type="text" class="size1 form-control" id="size1" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size2" class="control-label"><?= Yii::t('backend','SIZE2')?></label>
                            <input type="text" class="size2 form-control" id="size2" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size3" class="control-label"><?= Yii::t('backend','SIZE3')?></label>
                            <input type="text" class="size3 form-control" id="size3" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size4" class="control-label"><?= Yii::t('backend','SIZE4')?></label>
                            <input type="text" class="size4 form-control" id="size4" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size5" class="control-label"><?= Yii::t('backend','SIZE5')?></label>
                            <input type="text" class="size5 form-control" id="size5" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size6" class="control-label"><?= Yii::t('backend','SIZE6')?></label>
                            <input type="text" class="size6 form-control" id="size6" />
                        </div>
                    </div>
                </div>
                <div class="blocks">
                    <h3><?= Yii::t('backend','SHEET'); ?><span id="pluss_sheet"  class="fa fa-minus-circle" ></span></h3>
                    <div id="sheet" class="inner">
                        <div class="form-group field-frontendsetup-description">
                            <label for="prise" class="control-label"><?= Yii::t('backend','PRICE')?></label>
                            <?php echo Select2::widget([
                                'name' => 'price',
                                'data' => $prise,
                                'options' => [
                                    'placeholder' => Yii::t('backend','SELECTPRICE'),
                                ],
                                'pluginEvents' => [
                                    "change" => "function(e) { 
                                    document.getElementById('priseSheet').setAttribute('value',this.value); 
                                    }",],
                            ]); ?>
                            <?= Html::hiddenInput('prise','',['id'=>'priseSheet']) ?>
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size1" class="control-label"><?= Yii::t('backend','SIZE1')?></label>
                            <input type="text" class="size1 form-control" id="size1" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size2" class="control-label"><?= Yii::t('backend','SIZE2')?></label>
                            <input type="text" class="size2 form-control" id="size2" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size3" class="control-label"><?= Yii::t('backend','SIZE3')?></label>
                            <input type="text" class="size3 form-control" id="size3" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size4" class="control-label"><?= Yii::t('backend','SIZE4')?></label>
                            <input type="text" class="size4 form-control" id="size4" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size5" class="control-label"><?= Yii::t('backend','SIZE5')?></label>
                            <input type="text" class="size5 form-control" id="size5" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size6" class="control-label"><?= Yii::t('backend','SIZE6')?></label>
                            <input type="text" class="size6 form-control" id="size6" />
                        </div>
                    </div>
                </div>
                <div class="blocks">
                    <h3><?= Yii::t('backend','PILLOWCASES'); ?><span id="pluss_sheet"  class="fa fa-minus-circle" ></span></h3>
                    <div id="pillowcases" class="inner">
                        <div class="form-group field-frontendsetup-description">
                            <label for="prise" class="control-label"><?= Yii::t('backend','PRICE')?></label>
                            <?php echo Select2::widget([
                                'name' => 'price',
                                'data' => $prise,
                                'options' => [
                                    'placeholder' => Yii::t('backend','SELECTPRICE'),
                                ],
                                'pluginEvents' => [
                                    "change" => "function(e) { 
                                    document.getElementById('prisePillowcases').setAttribute('value',this.value); 
                                    }",],
                            ]); ?>
                            <?= Html::hiddenInput('prise','',['id'=>'prisePillowcases']) ?>
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size1" class="control-label"><?= Yii::t('backend','SIZE1')?></label>
                            <input type="text" class="size1 form-control" id="size1" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size2" class="control-label"><?= Yii::t('backend','SIZE2')?></label>
                            <input type="text" class="size2 form-control" id="size2" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size3" class="control-label"><?= Yii::t('backend','SIZE3')?></label>
                            <input type="text" class="size3 form-control" id="size3" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size4" class="control-label"><?= Yii::t('backend','SIZE4')?></label>
                            <input type="text" class="size4 form-control" id="size4" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size5" class="control-label"><?= Yii::t('backend','SIZE5')?></label>
                            <input type="text" class="size5 form-control" id="size5" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size6" class="control-label"><?= Yii::t('backend','SIZE6')?></label>
                            <input type="text" class="size6 form-control" id="size6" />
                        </div>
                    </div>
                </div>
                <div class="blocks">
                    <h3><?= Yii::t('backend','DUVETCOVER'); ?><span id="pluss_sheet"  class="fa fa-minus-circle"  ></span></h3>
                    <div id="duvetcover" class="inner">
                        <div class="form-group field-frontendsetup-description">
                            <label for="prise" class="control-label"><?= Yii::t('backend','PRICE')?></label>
                            <?php echo Select2::widget([
                                'name' => 'price',
                                'data' => $prise,
                                'options' => [
                                    'placeholder' => Yii::t('backend','SELECTPRICE'),
                                ],
                                'pluginEvents' => [
                                    "change" => "function(e) { 
                                    document.getElementById('priseDuvetscover').setAttribute('value',this.value); 
                                    }",],
                            ]); ?>
                            <?= Html::hiddenInput('prise','',['id'=>'priseDuvetscover']) ?>
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size1" class="control-label"><?= Yii::t('backend','SIZE1')?></label>
                            <input type="text" class="size1 form-control" id="size1" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size2" class="control-label"><?= Yii::t('backend','SIZE2')?></label>
                            <input type="text" class="size2 form-control" id="size2" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size3" class="control-label"><?= Yii::t('backend','SIZE3')?></label>
                            <input type="text" class="size3 form-control" id="size3" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size4" class="control-label"><?= Yii::t('backend','SIZE4')?></label>
                            <input type="text" class="size4 form-control" id="size4" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size5" class="control-label"><?= Yii::t('backend','SIZE5')?></label>
                            <input type="text" class="size5 form-control" id="size5" />
                        </div>
                        <div class="form-group field-frontendsetup-description">
                            <label for="size6" class="control-label"><?= Yii::t('backend','SIZE6')?></label>
                            <input type="text" class="size6 form-control" id="size6" />
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>


    <div class="form-group">
        <?= Html::a(Yii::t('backend','SECURE'),'#',['class'=>'btn btn-info','id'=>'secure']) ?>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
