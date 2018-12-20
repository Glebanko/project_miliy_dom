<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','MESSAGE');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','NEW_MESSAGE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id_user',
                'label'    =>'Пользователь',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    $id=$model->id;
                    return $model->getUser($id);
                }
            ],

            'title',
            'description',
            //'create_at',
            // 'type',
            // 'question',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
