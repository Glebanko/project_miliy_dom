<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = Yii::t('backend','UPDATE_CATEGORY') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','CATEGORY'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','UPDATE_CATEGORY');
?>
<div class="category-update patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
        'path'  => $path,
        'name'  => $name,
        'parent'=> $parent
    ]) ?>

</div>
