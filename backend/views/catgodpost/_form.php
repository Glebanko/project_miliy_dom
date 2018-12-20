<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Catgodpost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catgodpost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_cat')->textInput() ?>

    <?= $form->field($model, 'id_gods')->textInput() ?>

    <?= $form->field($model, 'id_post')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
