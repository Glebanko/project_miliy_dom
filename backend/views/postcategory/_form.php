<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
$cat = ArrayHelper::map($category,'id','name');

/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frontend-setup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key_setup')->hiddenInput(['value'=>'новости'])->label(false); ?>

    <?= $form->field($model, 'vaelye')->widget(Select2::classname(), [
        'data' => $cat,
        'language' => 'de',
        'options' => ['placeholder' => Yii::t('backend','ADDMENUCAT')],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Категории'); ?>

    <?= $form->field($model, 'description')->hiddenInput(['value' => 'postcategory'])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
