<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\select2\Select2;
use common\models\Addlfeild;

/* @var $this yii\web\View */
/* @var $model common\models\Gods */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Gods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$form=\yii\widgets\ActiveForm::begin();
echo $form->field($model, 'seasons')->widget(Select2::classname(), [
    'data' => Addlfeild::$season,
    'language' => 'ru',
    'options' => ['placeholder' => 'выбирите сезон','multiple' => true],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);   ?>
<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php $form::end();
?>
