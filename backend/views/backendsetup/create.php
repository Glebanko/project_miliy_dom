<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BackendSetup */

$this->title = 'Create Backend Setup';
$this->params['breadcrumbs'][] = ['label' => 'Backend Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-setup-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
