<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frontend-setup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($model->isNewRecord){

        echo $form->field($model, 'key_setup')->widget(Select2::classname(), [
            'data' => $manufacturer,
            'language' => 'ru',
            'options' => ['placeholder' => Yii::t('backend','MANUFACTURER')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
    }else{
        echo Select2::widget([
            'name'=>'id',
            'value' => $value,
            'data' => $manufacturer,
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
    }?>

    <?= $form->field($model, 'vaelye')->textInput(['maxlength' => true])->label(Yii::t('backend','URL')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
