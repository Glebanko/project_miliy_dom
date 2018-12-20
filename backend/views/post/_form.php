<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug_post')->textInput(['maxlength' => true]) ?>

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
                 var path =  '/frontend/web/image/post/'+date.getFullYear()+'/'+ mounth +'/'+file.name;
                 var img = document.createElement('img');
                 img.src = path; document.getElementById('forIMG').appendChild(img);
                 img.width=100;
                 var value=document.getElementById('post-image').getAttribute('value');
                 if(value==undefined){
                    var name=file.name
                 }else{ 
                    var name =value+',%, '+file.name } 
                 document.getElementById('post-image').setAttribute('value',name)}",
            'removedfile' => "function(file){
                var date = new Date(); 
                var path =  '/frontend/web/image/post/'+date.getFullYear()+'/'+(1+date.getMonth())+'/'+file.name; 
                var images = document.getElementsByTagName('img');
                var value = document.getElementById('post-image').value;
                string=',%, '+file.name
                if(value.indexOf(string)!=-1){
                    newvalue = value.replace(string,'');
    
                }else if(value.indexOf(file.name)!=-1){
                    newvalue = value.replace(file.name,'');
                }else{
                    newvalue = value
                }
                document.getElementById('post-image').value = newvalue;
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
            echo Html::img(Yii::getAlias('@frontendWebroot/image/').$path.'/'.$name,['width'=>100]);
        }
        ?>
    </div>

    <?= $form->field($model, 'description_post')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);?>

    <?=$form->field($model, 'image')->hiddenInput(/*['value'=>'0']*/)->label(false); ?>

    <?= $form->field($model, 'quote')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'news')->hiddenInput(['value'=>0])->label(false) ?>

    <?= $form->field($model, 'data')->hiddenInput(['value'=>date('Y-m-d',time())])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
