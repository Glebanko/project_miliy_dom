<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Addlfeild */

$this->title = Yii::t('backend','UPDATEFEILDS') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','ADDFEILDS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="addlfeild-update patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'feild' => $feild
    ]) ?>

</div>
