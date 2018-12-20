<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */

$this->title = Yii::t('backend','createTableDefault');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','tableDefault'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-setup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'firmDefault'   =>  $firmDefault
    ]) ?>

</div>
