<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BackendsetupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Backend Setups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-setup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Backend Setup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_feild',
            'key_feild',
            'value_feild',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
