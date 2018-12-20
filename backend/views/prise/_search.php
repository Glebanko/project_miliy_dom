<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PriseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prise-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sites') ?>

    <?= $form->field($model, 'addtional') ?>

    <?= $form->field($model, 'price1') ?>

    <?= $form->field($model, 'price2') ?>

    <?php // echo $form->field($model, 'priceEvro') ?>

    <?php // echo $form->field($model, 'priceSem') ?>

    <?php // echo $form->field($model, 'wholesale') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'upedate_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
