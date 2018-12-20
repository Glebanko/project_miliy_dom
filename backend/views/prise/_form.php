<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Prise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prise-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sites')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'price1')->textInput() ?>

    <?= $form->field($model, 'price2')->textInput() ?>

    <?= $form->field($model, 'priceEvro')->textInput() ?>

    <?= $form->field($model, 'priceSem')->textInput() ?>

    <?= $form->field($model, 'addtional')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wholesale')->textInput() ?>
    
    <?php if($model->isNewRecord) { ?>
        <?= $form->field($model, 'created_at')->hiddenInput(['value'=>time()])->label(false); ?>
    <?php }else{ ?>
        <?= $form->field($model, 'upedate_at')->hiddenInput(['value'=>time()])->label(false); ?>
    <?php }?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
