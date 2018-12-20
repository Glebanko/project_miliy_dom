<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'received_sell')->dropDownList(['0'=>'Новый заказ','1'=>'Принятый','2'=>'Выполненый','3'=>'Отказ','4'=>'Отменен']); ?>
    <?= $form->field($model,'admin_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false);?>

    <div class="form-group">
        <?= Html::submitButton( Yii::t('backend','UPDATE'), ['class' =>  'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
