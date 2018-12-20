<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = Yii::t('backend','CREATE_COMMENTS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','COMMMENT'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'goods' => $goods,
        'user'  =>  $user,
    ]) ?>

</div>
