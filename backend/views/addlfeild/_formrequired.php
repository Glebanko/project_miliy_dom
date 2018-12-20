<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\Addlfeild */
/* @var $form yii\widgets\ActiveForm */
if($requere){
    echo 'Возникли следушие ошибки<br/>';
    var_dump($requere);
}
?>

<div class="addlfeild-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'article')->textInput() ?>
    <?= $form->field($model, 'country')->textInput() ?>
    <?= $form->field($model, 'delivery')->textInput() ?>
    <?= $form->field($model, 'keywords')->textInput() ?>
    <?= $form->field($model, 'composition')->textInput() ?>
    <?= $form->field($model, 'size')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
