<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'slug_post',
            //'description_post',
            'quote',
            // 'news',
            // 'data',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{seo}&nbsp;&nbsp;{image}&nbsp;&nbsp;{price}&nbsp;&nbsp;{delete}',
                'buttons' =>
                    [
                        'seo' => function ($url, $model) {
                            return Html::a('<span class="fa fa-plus"></span>', Url::to(['/addlfeild/index', 'AddlfeildSearch[id_post]' => $model->id, 'class'=>'id_post']));},
                        'image' => function ($url, $model) {
                            return Html::a('<span class="fa fa-picture-o"></span>', Url::to(['/image/index', 'ImageSearch[id_post]' => $model->id, 'class'=>'post','feild'=>'id_post']));},
                    ]
            ],
        ],
    ]); ?>
</div>
