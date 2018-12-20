<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frontend-setup-form col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key_setup')->textInput(['maxlength' => true]) /*?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <h2>Слайдер левая</h2>
        <?= \zainiafzan\widget\Dropzone::widget([
            'options' => [
                'addRemoveLinks'    => true,
                'url'               => 'create',
            ],
            'clientEvents' => [
                'complete' => "function(file,dataUrl){
                    var date = new Date();
                     var path =  '/frontend/web/image/frontendImage/avatar-'+file.name;
                     var img = document.createElement('img');
                     var value=document.getElementById('frontendsetup-vaelye').getAttribute('value');
                     if(value==undefined){
                        var name='left-'+file.name
                     }else{
                        var name =value+',%,left-'+file.name }
                     document.getElementById('frontendsetup-vaelye').setAttribute('value',name)}",
                'removedfile' => "function(file){
                    var date = new Date();
                    var path =  '/frontend/web/image/page/frontendImage/avatar-'+file.name;
                    var images = document.getElementsByTagName('img');
                    var value = document.getElementById('frontendsetup-vaelye').value;
                    console.log(value);
                    string=',%,left-'+file.name
                    if(value.indexOf(string)!=-1){
                        alert('yes');
                        newvalue = value.replace(string,'');

                    }else if(value.indexOf(file.name)!=-1){
                        newvalue = value.replace('left-'+file.name,'');
                        console.log(newvalue);
                    }else{
                        newvalue = value
                    }
                    document.getElementById('frontendsetup-vaelye').value = newvalue;
                    }",
                'success'=>'function(file){console.log(file)}',
                'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
            ]
        ])?>
    </div><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <h2>Слайдер средняя</h2>
        <?= \zainiafzan\widget\Dropzone::widget([
            'options' => [
                'addRemoveLinks'    => true,
                'url'               => 'create',
            ],
            'clientEvents' => [
                'complete' => "function(file,dataUrl){
                    var date = new Date();
                     var path =  '/frontend/web/image/frontendImage/avatar-'+file.name;
                     var img = document.createElement('img');
                     var value=document.getElementById('frontendsetup-vaelye').getAttribute('value');
                     if(value==undefined){
                        var name='center-'+file.name
                     }else{
                        var name =value+',%,center-'+file.name }
                     document.getElementById('frontendsetup-vaelye').setAttribute('value',name)}",
                'removedfile' => "function(file){
                    var date = new Date();
                    var path =  '/frontend/web/image/page/frontendImage/avatar-'+file.name;
                    var images = document.getElementsByTagName('img');
                    var value = document.getElementById('frontendsetup-vaelye').value;
                    string=',%,center-'+file.name
                    if(value.indexOf(string)!=-1){
                        alert('yes');
                        newvalue = value.replace(string,'');

                    }else if(value.indexOf(file.name)!=-1){
                        newvalue = value.replace('center-'+file.name,'');
                        console.log(newvalue);
                    }else{
                        newvalue = value
                    }
                    document.getElementById('frontendsetup-vaelye').value = newvalue;
                    }",
                'success'=>'function(file){console.log(file)}',
                'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
            ]
        ])?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <h2>Слайдер правая</h2>
        <?= \zainiafzan\widget\Dropzone::widget([
            'options' => [
                'addRemoveLinks'    => true,
                'url'               => 'create',
            ],
            'clientEvents' => [
                'complete' => "function(file,dataUrl){
                    var date = new Date();
                     var path =  '/frontend/web/image/frontendImage/avatar-'+file.name;
                     var img = document.createElement('img');
                     var value=document.getElementById('frontendsetup-vaelye').getAttribute('value');
                     if(value==undefined){
                        var name='right-'+file.name
                     }else{
                        var name =value+',%,right-'+file.name }
                     document.getElementById('frontendsetup-vaelye').setAttribute('value',name)}",
                'removedfile' => "function(file){
                    var date = new Date();
                    var path =  '/frontend/web/image/page/frontendImage/avatar-'+file.name;
                    var images = document.getElementsByTagName('img');
                    var value = document.getElementById('frontendsetup-vaelye').value;
                    string=',%,right-'+file.name
                    if(value.indexOf(string)!=-1){
                        alert('yes');
                        newvalue = value.replace(string,'');

                    }else if(value.indexOf(file.name)!=-1){
                        newvalue = value.replace('right-'+file.name,'');
                        console.log(newvalue);
                    }else{
                        newvalue = value
                    }
                    document.getElementById('frontendsetup-vaelye').value = newvalue;
                    }",
                'success'=>'function(file){console.log(file)}',
                'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
            ]
        ])*/?>
    </div>
    <div class="col-lg-24 col-md-24">
        <h2>Слайдер фон</h2>
        <?= \zainiafzan\widget\Dropzone::widget([
            'options' => [
                'addRemoveLinks'    => true,
                'url'               => 'create',
            ],
            'clientEvents' => [
                'complete' => "function(file,dataUrl){
                    var date = new Date();
                     var path =  '/frontend/web/image/frontendImage/avatar-'+file.name;
                     var img = document.createElement('img');
                     var value=document.getElementById('frontendsetup-vaelye').getAttribute('value');
                     if(value==undefined){
                        var name='back-'+file.name
                     }else{ 
                        var name =value+',%,back-'+file.name } 
                     document.getElementById('frontendsetup-vaelye').setAttribute('value',name)}",
                'removedfile' => "function(file){
                    var date = new Date(); 
                    var path =  '/frontend/web/image/page/frontendImage/avatar-'+file.name; 
                    var images = document.getElementsByTagName('img');
                    var value = document.getElementById('frontendsetup-vaelye').value;
                    string=',%,back-'+file.name
                    if(value.indexOf(string)!=-1){
                        alert('yes');
                        newvalue = value.replace(string,'');
        
                    }else if(value.indexOf(file.name)!=-1){
                        newvalue = value.replace('back-'+file.name,'');
                        console.log(newvalue);
                    }else{
                        newvalue = value
                    }
                    document.getElementById('frontendsetup-vaelye').value = newvalue;                
                    }",
                'success'=>'function(file){console.log(file)}',
                'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
            ]
        ])/*?>
    </div>
    <?=$form->field($model, 'pages')->textarea()->label('в ведите текст'); ?>
    <a class="btn btn-danger" href="#" id="addTextSlider">Добавить текст</a> */?>
    <?= $form->field($model, 'vaelye')->hiddenInput(['value'=> false])->label(false); ?>

    <?= $form->field($model, 'description')->hiddenInput(['value' => 'slider'])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
