<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = Yii::t('backend','UPDATEIMAGES') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','IMAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','UPDATE');
?>
<div class="image-update patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'feild'=>   $feild,
        'class'=>$class
    ]) ?>

</div>
