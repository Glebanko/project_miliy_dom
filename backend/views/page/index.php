<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','PAGE');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','CREATE_PAGE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'slug_page',
            'office',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{seo}&nbsp;&nbsp;{image}&nbsp;&nbsp;{price}&nbsp;&nbsp;{delete}',
                'buttons' =>
                    [
                        'seo' => function ($url, $model) {
                            return Html::a('<span class="fa fa-plus"></span>', Url::to(['/addlfeild/index', 'AddlfeildSearch[id_page]' => $model->id, 'class'=>'id_page']));},
                        'image' => function ($url, $model) {
                            return Html::a('<span class="fa fa-picture-o"></span>', Url::to(['/image/index', 'ImageSearch[id_page]' => $model->id, 'class'=>'page','feild'=>'id_page']));},
                    ]
            ],
        ],
    ]); ?>
</div>
