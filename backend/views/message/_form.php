<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) /*?>

    <?= $form->field($model, 'create_at')->textInput()*/ ?>

    <?= $form->field($model, 'type')->dropDownList(['0' => 'Чат', '1' => 'пуш',]); ?>
    <?php if($model->isNewRecord){}else{ ?>
        <?= $form->field($model, 'question')->textInput() ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE'): Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
