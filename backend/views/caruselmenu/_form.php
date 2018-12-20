<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$cat=ArrayHelper::map($category,'id','name');

/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frontend-setup-form">
        <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->field($model, 'menus')->widget(Select2::classname(), [
            'data' => $cat,
            'language' => 'de',
            'options' => ['placeholder' => Yii::t('backend','ADDMENUCAT')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Категории'); ?>

        <a href="#" id="caraddCatMenu" class="btn btn-success" ><?= Yii::t('backend','ADDMENUCAT') ?></a>
        <?= \zainiafzan\widget\Dropzone::widget([
            'options' => [
                'addRemoveLinks'    => true,
                'url'               => 'create',
            ],
            'clientEvents' => [
                'complete' => "function(file,dataUrl){ document.getElementById('frontendsetup-vaelye').value=file.name;}",
                'removedfile' => "function(file){document.getElementById('frontendsetup-vaelye').value=''}",
                'success'=>'function(file){console.log(file)}',
                'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
            ]
        ])?>

        <?= $form->field($model, 'key_setup')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'vaelye')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'description')->hiddenInput(['value' => 'carmenu'])->label(false) ?>

        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
