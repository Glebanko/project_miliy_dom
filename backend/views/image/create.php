<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = Yii::t('backend','CREATEIMAGE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','IMAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     =>  $model,
        'image'     =>  $image,
        'feild'     =>  $feild,
        'class'     =>  $class
    ]) ?>

</div>
