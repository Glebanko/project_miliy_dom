<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Prise */

$this->title = Yii::t('backend','UPDATEPRICE').': ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','PRICE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['views', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','UPDATE');
?>
<div class="prise-update patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
