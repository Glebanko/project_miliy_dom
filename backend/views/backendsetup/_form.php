<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BackendSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="backend-setup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_feild')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key_feild')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_feild')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
