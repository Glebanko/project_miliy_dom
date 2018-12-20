<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'public')->textInput() ?>

    <?= $form->field($model, 'public')->radioList([
        '1'=>'Опубликовано',
        '0'=>'Не опубликовано',
    ])->label(false); ?>

    <?= $form->field($model, 'what')->radioList([
        '1'=>'На товар',
        '0'=>'На главную',
    ])->label(false); ?>

    <?php if($model->isNewRecord){

     echo DatePicker::widget([
        'name' => 'strtotimes',
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'language'  => 'ru',
        'value' => date('d-M-Y', time()),
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);

        echo $form->field($model, 'id_gods')->widget(Select2::classname(), [
            'data' => $goods,
            'language' => 'ru',
            'options' => ['placeholder' => Yii::t('backend','SELECTGODS')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
        echo $form->field($model, 'user_id')->widget(Select2::classname(), [
            'data' => $user,
            'language' => 'ru',
            'options' => ['placeholder' => Yii::t('backend','SELECTUSER')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
    }else{
        if(isset($model->created_at)) {
            echo DatePicker::widget([
                'name' => 'strtotimes',
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'language'  => 'ru',
                'value' => date('d-M-Y', $model->created_at),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true
                ]
            ]);
        }else{
             echo DatePicker::widget([
                'name' => 'strtotimes',
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'language'  => 'ru',
                'value' => date('d-M-Y', time()),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true
                ]
            ]);
        }
        if(isset($dataGoods)) {
            echo Select2::widget([
                'name' => 'id',
                'value' => $dataGoods,
                'data' => $goods,
                'pluginOptions' => [
                    'tags' => true,
                ],
            ]);
        }else{
            echo $form->field($model, 'id_gods')->widget(Select2::classname(), [
                'data' => $goods,
                'language' => 'ru',
                'options' => ['placeholder' => Yii::t('backend','SELECTGODS')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
        }
        echo Select2::widget([
            'name'=>'id',
            'value' => $dataUser,
            'data' => $user,
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
    }?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
