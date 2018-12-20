<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */

$this->title = 'Create Frontend Setup';
$this->params['breadcrumbs'][] = ['label' => 'Frontend Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-setup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
