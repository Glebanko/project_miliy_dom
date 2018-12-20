<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug_page')->textInput(['maxlength' => true]) ?>

    <?= \zainiafzan\widget\Dropzone::widget([
        'options' => [
            'addRemoveLinks'    => true,
            'url'               => 'create',
        ],
        'clientEvents' => [
            'complete' => "function(file,dataUrl){
                var date = new Date();
                var mounth=date.getMonth() + 1;
                if (mounth < 10) mounth = '0' + mounth;
                 var path =  '/frontend/web/image/page/'+date.getFullYear()+'/'+ mounth +'/avatar-'+file.name;
                 var img = document.createElement('img');
                 img.src = path; document.getElementById('forIMG').appendChild(img);
                 var value=document.getElementById('page-image').getAttribute('value');
                 if(value==undefined){
                    var name=file.name
                 }else{ 
                    var name =value+',%, '+file.name } 
                 document.getElementById('page-image').setAttribute('value',name)}",
            'removedfile' => "function(file){
                var date = new Date(); 
                var path =  '/frontend/web/image/page/'+date.getFullYear()+'/'+(1+date.getMonth())+'/avatar-'+file.name; 
                var images = document.getElementsByTagName('img');
                var value = document.getElementById('page-image').value;
                string=',%, '+file.name
                if(value.indexOf(string)!=-1){
                    newvalue = value.replace(string,'');
    
                }else if(value.indexOf(file.name)!=-1){
                    newvalue = value.replace(file.name,'');
                }else{
                    newvalue = value
                }
                document.getElementById('page-image').value = newvalue;
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
    <?=$form->field($model, 'image')->hiddenInput(/*['value'=>'0']*/)->label(false); ?>
    <?= $form->field($model, 'description_page')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
