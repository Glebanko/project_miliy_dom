<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

if($priseparser){
    /*foreach ($priseparser as $pars){
       var_dump($pars);
    }*/
}else {

    ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    if($manufacturer){
        echo $form->field($model, 'value')->widget(Select2::classname(), [
            'data' => $manufacturer,
            'language' => 'ru',
            'options' => ['placeholder' => Yii::t('backend','MANUFACTURER')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false); }
    ?>
    <?= $form->field($model, 'files')->fileInput(); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'CREATE'), ['btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();
}?>

