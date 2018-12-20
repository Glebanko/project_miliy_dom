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

    <?= $form->field($model, 'vaelye')->textInput(['maxlength' => true])->label(Yii::t('backend','URL')) ?>

    <?= $form->field($model, 'description')->hiddenInput(['value' => 'social'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') :Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
