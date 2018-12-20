<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('backend','CREATE_PAGE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','PAGE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
        'path'  => $path,
        'name'  => $name
    ]) ?>

</div>
