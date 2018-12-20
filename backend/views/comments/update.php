<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = Yii::t('backend','UPDATE_COMMENTS').': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','COMMMENT'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comment-update patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'goods' => $goods,
        'user'  =>  $user,
        'dataGoods' =>$dataGoods,
        'dataUser'  =>$dataUser
    ]) ?>

</div>
