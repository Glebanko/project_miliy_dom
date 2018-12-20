<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','CATEGORY');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','NEW_CATEGORY'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'name',
            'slug_category',
            'description_category',
            [
                'attribute'=>'parrent_category',
                'label'    =>'Категория родитель',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    $id=$model->parrent_category;
                    return $model->getParrentCat($id);
                }
            ],
            'size',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{seo}&nbsp;&nbsp;{image}&nbsp;&nbsp;{delete}',
                'buttons' =>
                    [
                        'seo' => function ($url, $model) {
                            return Html::a('<span class="fa fa-plus"></span>', Url::to(['/addlfeild/index', 'AddlfeildSearch[id_cat]' => $model->id, 'class'=>'id_cat']));},
                        'image' => function ($url, $model) {
                            return Html::a('<span class="fa fa-picture-o"></span>', Url::to(['/image/index', 'ImageSearch[id_cat]' => $model->id, 'class'=>'cat','feild'=>'id_cat']));},
                         ]
            ],
        ],
    ]); ?>
</div>
