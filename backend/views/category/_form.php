<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Url;

$cat = ArrayHelper::map($parent, 'id', 'name');
$modul= array(['1'=>'Товары','2'=>'Новости','3'=>'Служебные'])

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
//var_dump($cat);
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug_category')->textInput(['maxlength' => true]) ?>
    <?php if(isset($image)){ ?>

        <?= Html::a(Html::img(Yii::getAlias('@frontendWebroot/image/').$image->path.'/'.$image->path), Url::to(['/image/update', 'id' => $image->id])) ?>
    <?php } ?>
    <?= \zainiafzan\widget\Dropzone::widget([
        'options' => [
            'addRemoveLinks'    => true,
            'url'               => 'create',
        ],
        'clientEvents' => [
            'complete' => "function(file,dataUrl){
                var date = new Date();
                 var path =  '/frontend/web/image/category/'+date.getFullYear()+'/'+(1+date.getMonth())+'/avatar-'+file.name;
                 var img = document.createElement('img');
                 img.src = path; document.getElementById('forIMG').appendChild(img);
                 var value=document.getElementById('category-image').getAttribute('value');
                 if(value==undefined){
                    var name=file.name
                 }else{ 
                    var name =value+',%, '+file.name } 
                 document.getElementById('category-image').setAttribute('value',name)}",
            'removedfile' => "function(file){
                var date = new Date(); 
                var path =  '/frontend/web/image/categpry/'+date.getFullYear()+'/'+(1+date.getMonth())+'/avatar-'+file.name; 
                var images = document.getElementsByTagName('img');
                var value = document.getElementById('category-image').value;
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
                document.getElementById('category-image').value = newvalue;
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

    <?= $form->field($model, 'description_category')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'parrent_category')->widget(Select2::classname(), [
        'data' => $cat,
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбирите родителя'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'modulcategory')->widget(Select2::classname(), [
        'data' => $modul,
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбирите тему'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?php if($model->isNewRecord){
        echo $form->field($model, 'size')->widget(Select2::classname(), [
            'data' => [null=>'Другое','Одежда'=>'Одежда','Постельное'=>'Постельное','Аксессуары'=>'Аксессуары','Полуторное'=>'Полуторное'],
            'language' => 'ru',
            'options' => ['placeholder' => 'Выбирите размер'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    }else{ ?>
        <div class="form-group field-category-size">
        <label class="control-label" for="category-size">Выбирите на стандартный размер для дома</label>
        <?= Select2::widget([
            'name'=>'Category[size]',
            'value' => $model->size,
            'data' => [null=>'Другое','Одежда'=>'Одежда','Постельное'=>'Постельное','Аксессуары'=>'Аксессуары','Полуторное'=>'Полуторное'],
            'options'=>['id'=>"category-size"],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]); ?>
        </div>
    <?php } ?>
    <?= $form->field($model, 'templates')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE') , ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
