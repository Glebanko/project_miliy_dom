<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */
/* @var $form yii\widgets\ActiveForm */
$cat=ArrayHelper::map($category,'id','name');
?>

<div class="frontend-setup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key_setup')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'menus')->widget(Select2::classname(), [
        'data' => $cat,
        'language' => 'de',
        'options' => ['placeholder' => Yii::t('backend','ADDMENUCAT')],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Категории'); ?>
    <a href="#" id="addCatImage" class="btn btn-success" ><?= Yii::t('backend','ADDCATIMG') ?></a>

    <?= \zainiafzan\widget\Dropzone::widget([
        'options' => [
            'addRemoveLinks'    => true,
            'url'               => 'create',
        ],
        'clientEvents' => [
            'complete' => "function(file,dataUrl){
                     var value=document.getElementById('frontendsetup-vaelye').getAttribute('value');
                     if(value==undefined){
                        var name='image-'+file.name;
                     }else{ 
                        var name =value+',%,image-'+file.name; } 
                     document.getElementById('frontendsetup-vaelye').setAttribute('value',name)}",
            'removedfile' => "function(file){
                    var value = document.getElementById('frontendsetup-vaelye').value;
                    string=',%,image'+file.name
                    if(value.indexOf(string)!=-1){
                        newvalue = value.replace(string,'');
                    }else if(value.indexOf(file.name)!=-1){
                        newvalue = value.replace('image-'+file.name,'');
                    }else{
                        newvalue = value;
                    }
                    document.getElementById('frontendsetup-vaelye').value = newvalue;                
                    }",
            'success'=>'function(file){console.log(file)}',
            'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
        ]
    ])?>
    <?=$form->field($model, 'pages')->textInput()->label('в ведите текст'); ?>
    <a class="btn btn-danger" href="#" id="addTextSlider">Добавить текст</a>

    <?= $form->field($model, 'vaelye')->hiddenInput(['value' => ''])->label(false) ?>
    <?= $form->field($model, 'description')->hiddenInput(['value' => 'catsetup'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE'): Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
