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

    <?= $form->field($model, 'key_setup')->widget(Select2::classname(), [
        'data' => $firmDefault,
        'language' => 'ru',
        'options' => ['placeholder' => Yii::t('backend','SELECTFIRM')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false); ?>

    <?= \zainiafzan\widget\Dropzone::widget([
        'options' => [
            'addRemoveLinks'    => true,
            'url'               => 'create',
        ],
        'clientEvents' => [
            'complete' => "function(file,dataUrl){
                 var value=document.getElementById('frontendsetup-vaelye').getAttribute('value');
                 if(value==undefined){
                    var name=file.name
                 }else{ 
                    var name =value+',%, '+file.name } 
                 document.getElementById('frontendsetup-vaelye').setAttribute('value',name)}",
            'removedfile' => "function(file){
                var value = document.getElementById('frontendsetup-vaelye').value;
                string=',%, '+file.name
                if(value.indexOf(string)!=-1){
                    newvalue = value.replace(string,'');
    
                }else if(value.indexOf(file.name)!=-1){
                    newvalue = value.replace(file.name,'');
                }else{
                    newvalue = value
                }
                document.getElementById('frontendsetup-vaelye').value = newvalue;
                }",
            'success'=>'function(file){console.log(file)}',
            'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
        ]
    ])?>

    <?= $form->field($model, 'vaelye')->HiddenInput(['maxlength' => true])->label(false); ?>

    <?= $form->field($model, 'description')->HiddenInput(['value'=>'tableDefault'])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','Create') : Yii::t('backend','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
