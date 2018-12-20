<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Addlfeild */

$this->title = Yii::t('backend','CREATEFEILDS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','ADDFEILDS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="addlfeild-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'feild' =>  $feild
    ]) ?>

</div>
