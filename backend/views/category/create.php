<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = Yii::t('backend','NEW_CATEGORY');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','CATEGORY'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create  patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
        'path'  => $path,
        'name'  => $name,
        'parent'=> $parent
    ]) ?>

</div>
