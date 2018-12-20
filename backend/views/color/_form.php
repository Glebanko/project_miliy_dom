<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frontend-setup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key_setup')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-control-label ">
        <label class="control-label" for="control-label"><?= Yii::t('backend','SELECTCOLOR') ?></label>
        <input class="color-input form-control"  id='control-label' value="#F80" />
    </div>
    <?= $form->field($model, 'vaelye')->hiddenInput(['rows' => 6,'id'=>'colorInput'])->label(false); ?>

    <?= $form->field($model, 'description')->hiddenInput(['value'=>'color'])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
