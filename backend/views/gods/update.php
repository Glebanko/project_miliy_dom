<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gods */

$this->title = Yii::t('backend','UPDATE_GODS') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','GODS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','UPDATE');
?>
<div class="gods-update patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     =>  $model,
        'image'     =>  $image,
        'prise'     =>  $prise,
        'addfeild'  =>  $addfeild,
        'allPrice'  =>  $allPrice,
        'onePrice'  =>  $onePrice,
        'color'     =>  $color,
        'categorys' =>  $categorys,
        'catgods'    =>  $catgods,
        'currency'  =>  $currency,
        'tablesize' =>  $tablesize,
        'sizeInSelect'  =>  $sizeInSelect,
        'colorInSelect' =>  $colorInSelect
    ]) ?>

</div>
