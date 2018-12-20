<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Prise */

$this->title = Yii::t('backend','CREATEPRICE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','PRICE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prise-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
