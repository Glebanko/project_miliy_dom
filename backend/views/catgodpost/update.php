<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Catgodpost */

$this->title = 'Update Catgodpost: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Catgodposts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="catgodpost-update patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
