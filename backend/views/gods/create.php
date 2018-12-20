<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Gods */

$this->title = Yii::t('backend','CREATE_GODS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','GODS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gods-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     =>  $model,
        'image'     =>  $image,
        'prise'     =>  $prise,
        'addfeild'  =>  $addfeild,
        'allPrice'  =>  $allPrice,
        'categorys' =>  $categorys,
        'catgods'    =>  $catgods,
        'currency'  =>  $currency,
        'tablesize' =>  $tablesize,
        'sizeInSelect'  =>  $sizeInSelect,
        'colorInSelect' =>  $colorInSelect
    ]) ?>

</div>
