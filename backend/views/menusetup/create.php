<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */

$this->title = Yii::t('backend','CREATEMENU');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','MENUSETUP'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-setup-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category'  =>  $category,
        'pages' =>  $pages,
        'value'     =>  $value
    ]) ?>

</div>
