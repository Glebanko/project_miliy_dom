<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2; ?>
<div class="addlfeild-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'value')->widget(Select2::classname(), [
        'data' => $provider,
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбирите поставщика'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(Yii::t('backend','Name_provider')); ?>
    <?= $form->field($model, 'key_feild')->hiddenInput(['value'=>'name_provider'])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <div id="inner"></div>

    <?php ActiveForm::end(); ?>
</div>
