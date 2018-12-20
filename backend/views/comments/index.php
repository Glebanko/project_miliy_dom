<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','COMMMENT');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','CREATE_COMMENTS'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id_gods',
                'format'    =>  'raw',
                'value'     =>  function($model){
                    return $model->getGoods($model->id_gods);
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $goods,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
            ],
            [
                'attribute'  =>  'user_id',
                'format'        =>  'raw',
                'value'         =>  function($model){
                    return $model->getUsers($model->user_id);
                }
            ],
            'title',
            'text',
            [
                    'attribute' =>  'created_at',
                    'format'    =>  'date',
                    'xlFormat'  =>  "dd-mm-yyyy",
                /* 'filterType'=>GridView::FILTER_DATE,
                    'terWidgetOptions'=>[
                    '    'name' => 'from_date',
                        'value' => '01-Feb-1996',
                        'type' => DatePicker::TYPE_RANGE,
                        'name2' => 'to_date',
                        'value2' => '27-Feb-1996',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd-mm-yyyy'
                    ]
                ],*/
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
