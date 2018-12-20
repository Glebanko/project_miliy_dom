<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Catgodpost */

$this->title = 'Create Catgodpost';
$this->params['breadcrumbs'][] = ['label' => 'Catgodposts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catgodpost-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
