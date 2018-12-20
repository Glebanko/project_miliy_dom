<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CatgodpostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catgodposts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catgodpost-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Catgodpost', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,goods/dly_nee/
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_cat',
            'id_gods',
            'id_post',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
