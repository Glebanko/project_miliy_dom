<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider
 * @var $model common\models\Orders
 */

$this->title = Yii::t('backend','ORDERS');
$this->params['breadcrumbs'][] = $this->title;
//$this->params['body-class'] = ' goods';
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            
            [
                'attribute'=>'image',
                'format'=>'raw',
                'label'=>  Yii::t('backend','dataGoodsImage'),
                'value'=> function($model,$key){
                    foreach ($model->baskets as $bascet){
                        if(is_object($bascet->gods)&&is_object($bascet->gods->homeImage))
                            return Html::img(Yii::$app->params['url'].'frontend/web/image/'. $bascet->gods->homeImage->path . '' . $bascet->gods->homeImage->name, ['width' => 60]);
                    }
                }
            ],
            [
                'attribute'=>'id',
                'format'=>'raw',
                'label'=>  Yii::t('backend','dataGoods'),
                'value'=> function($model,$key){
                    return Html::a(Yii::t('backend','Order_number ').count($model->baskets),\yii\helpers\Url::to(['view','id'=>$model->id]));
                }
            ],
            
            [
                'attribute'=>'user_id',
                'format'=>'raw',
                'label'=>  Yii::t('backend','USERREGISTER'),
                'value'=> function($model,$key){
                    return $model->getUser($model->user_id);
                }
            ],
            [
                'attribute'=>'anonim_id',
                'format'=>'raw',
                'label'=>  Yii::t('backend','USERNOTREGISTER'),
                'value'=> function($model,$key){
                    return $model->getAnonimUser($model->anonim_id);
                }
            ],
            [
                'attribute'  => 'received_sell',
                'label'     =>  Yii::t('backend','Status'),
                'format'    =>  'raw',
                'value'     =>  function($model){
                    return $model->status;
                },
                 'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['0'=>'Новый заказ','1'=>'Принятый','2'=>'Выполненый','3'=>'Отказ','4'=>'Отменен','5'=>'Показать все'],
                'filterInputOptions'=>['placeholder'=>Yii::t('backend','SELECT_received_sell')]

            ],
            
            'datetime:datetime',
        ],
    ]); ?>
</div>
