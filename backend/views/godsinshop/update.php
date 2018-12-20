<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Godsinshop */

$this->title = Yii::t('backend','UPDATE_GODSINSHOPP') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','GODSINSHOP'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['views', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','UPDATE');
?>
<div class="godsinshop-update patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gods'  => $gods,
        'shop'  =>  $shop,
    ]) ?>

</div>
