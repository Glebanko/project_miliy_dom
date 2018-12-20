<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $bascet common\models\Basket */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Frontend Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-setup-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'image',
                'label'=>Yii::t('backend','IMAGE'),
                'format'=>  'raw',
                'value'=>function($model){
                    return Html::img(Yii::$app->params['url'] . 'frontend/web/image/' . $model->gods->homeImage->path . '' . $model->gods->homeImage->name, ['width' => 60]);
                }
            ],
            [
                'attribute'=>'goodsid',
                'format'=>  'raw',
                'value'=>function($model){
                    return Html::a($model->gods->title,Url::to(['/gods/index','GodsSearch[id]'=>$model->gods->id]));
                }
            ],
            [
                'attribute'=>'article',
                'label'=>Yii::t('backend','ARTICLE'),
                'format'=>  'raw',
                'value'=>function($model){
                    return $model->gods->article->value;
                }
            ],
            [
                'attribute'=>'size',
                'label'=>Yii::t('backend','SIZE'),
                'format'=>'raw',
                'value'=>function($model){
                    if(is_object($model->sizes))
                        return $model->sizes->value;
                    return 'размер не установлен';
                }
            ],
            [
                'attribute'=>'color',
                'label'=>Yii::t('backend','COLOR'),
                'format'=>'raw',
                'value'=>function($model){
                    if(is_object($model->colors))
                        return "<span class='fa fa-4 fa-square' style='color:".$model->colors->value."'></span>";
                    return Yii::t('backend','NOTCOLOR');
                }
            ],
            [
                'attribute'=>'price',
                'label'=>Yii::t('backend','PRICE'),
                'format'=>'raw',
                'value'=>function($model){
                    if(is_object($model->sizes))
                        return $model->prises->getPrices($model->sizes->key_feild).' грн.';
                    return 'выведена первая цена '. $model->prises->price1 .' грн.';
                }
            ],
            [
                'attribute'=>'quantity',
                'label'=>Yii::t('backend','QUANTITY'),
            ],
            [
                'attribute'=>'all_price',
                'label'=>Yii::t('backend','ALL_PRICE'),
                'value'=>function($model){
                    return $model->quantity * $model->prises->getPrices($model->sizes?$model->sizes->key_feild:null);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'user_id',
                'format'=>'raw',
                'label'=>  Yii::t('backend','USERREGISTER'),
                'value'=> function()use($model){
                    return $model->getUser($model->user_id);
                }
            ],
            [
                'attribute'=>'anonim_id',
                'format'=>'raw',
                'label'=>  Yii::t('backend','USERNOTREGISTER'),
                'value'=> function()use($model){
                    return $model->getAnonimUser($model->anonim_id);
                }
            ],
            [
                'attribute'  => 'comment',
                'label'     =>  Yii::t('backend','Comment'),
            ],

            [
                'attribute'  => 'all_count',
                'label'     =>  Yii::t('backend','All_count'),
                'value'     =>  function()use($model){
                    return count($model->baskets);
                }
            ],
            'datetime:datetime',
        ],
    ]) ?>
</div>
