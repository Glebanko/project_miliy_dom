<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>
<div class="gods-form patern">

    <?php $form = ActiveForm::begin(); ?>
    <div id="accordion">
        <h3><a href="#">Раздел 1</a></h3>
        <div>
            <p>
                <?= $form->field($model, 'patern')->widget(Select2::classname(), [
                    'data' => $paterns,
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('backend','SELECTPATTERN')],
                    'pluginOptions' => [
                        'allowClear' => true ],])->label(false); ?>
            </p>
        </div>
        <h3><a href="#">Раздел 1</a></h3>
        <div>
            <p>
                <?= $form->field($model, 'sheets')->widget(Select2::classname(), [
                    'data' => $price,
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('backend','ADDSHEETPRICE')],
                    'pluginOptions' => [
                    'allowClear' => true ],])->label(false); ?>
                <?= $form->field($model, 'sheetswhoseles')->widget(Select2::classname(), [
                    'data' => $price,
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('backend','ADDSHEETPRICEWHOSALES')],
                    'pluginOptions' => [
                    'allowClear' => true ], ])->label(false); ?>

                <?= $form->field($model, 'pillowcases')->widget(Select2::classname(), [
                    'data' => $price,
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('backend','ADDPILLOWCASE')],
                    'pluginOptions' => [
                    'allowClear' => true ],])->label(false); ?>
                <?= $form->field($model, 'pillowcaseswhoseles')->widget(Select2::classname(), [
                    'data' => $price,
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('backend','ADDPILLOWCASEPRICEWHOSALES')],
                    'pluginOptions' => [
                    'allowClear' => true ], ])->label(false); ?>

                <?= $form->field($model, 'duvetcover')->widget(Select2::classname(), [
                    'data' => $price,
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('backend','ADDDUVETCOVER')],
                    'pluginOptions' => [
                    'allowClear' => true ],])->label(false); ?>
                <?= $form->field($model, 'duvetcoverwhoseles')->widget(Select2::classname(), [
                    'data' => $price,
                    'language' => 'ru',
                    'options' => ['placeholder' => Yii::t('backend','ADDDUVETCOVERWHOSALES')],
                    'pluginOptions' => [
                    'allowClear' => true ], ])->label(false); ?>
            </p>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>