<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Godsinshop */

$this->title = Yii::t('backend','CREATE_GODSINSHOP');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','CODSINSHOP'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="godsinshop-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gods'  => $gods,
        'shop'  =>  $shop,
        'color' =>  $color,
        'size'  =>  $size,
        'id'    =>  $id
    ]) ?>

</div>
