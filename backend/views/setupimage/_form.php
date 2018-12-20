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
                 img.src = path; document.getElementById('forIMG').appendChild(img);
                 var value=document.getElementById('frontendsetup-vaelye').getAttribute('value');
                 if(value==undefined){
                    var name=file.name
                 }else{ 
                    var name =value+',%, '+file.name } 
                 document.getElementById('frontendsetup-vaelye').setAttribute('value',name)}",
            'removedfile' => "function(file){
                var date = new Date(); 
                var path =  '/frontend/web/image/page/frontendImage/avatar-'+file.name; 
                var images = document.getElementsByTagName('img');
                var value = document.getElementById('frontendsetup-vaelye').value;
                string=',%, '+file.name
                if(value.indexOf(string)!=-1){
                    alert('yes');
                    newvalue = value.replace(string,'');
    
                }else if(value.indexOf(file.name)!=-1){
                    newvalue = value.replace(file.name,'');
                    console.log(newvalue);
                }else{
                    newvalue = value
                }
                document.getElementById('frontendsetup-vaelye').value = newvalue;
                for(var i = 0; i < images.length; i++) {
                    var img = images[i];
                    if(img.getAttribute('src') == path)
                        img.parentNode.removeChild(img);
                    }
                 
                }",
            'success'=>'function(file){console.log(file)}',
            'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
        ]
    ])?>
    <div id="forIMG">
        <?php
        if(isset($image)) {
            echo Html::img(Yii::getAlias('@frontendWebroot/image/').$path.'avatar-'.$name);
        }
        ?>
    </div>
    <?= $form->field($model, 'vaelye')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'description')->hiddenInput(['value' => 'image']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
