<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DefaulttableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','tableDefault');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-setup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>   'key_setup',
                'label'    =>   Yii::t('backend','firmName'),
                
            ],
            [
                'attribute' =>  'vaelye',
                'label'     =>  Yii::t('backend','tableImage'),
                'format'    =>  'raw',
                'value'     =>  function($model){
                    return Html::img($model->vaelye,['height'=>200]);

                }
            ]
            ,
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
