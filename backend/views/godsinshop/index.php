<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\grid\GridView;
use common\models\Addlfeild;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\GodsinshopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$godDatas=ArrayHelper::map($gods,'id','title');

$shopDatas=ArrayHelper::map($shop,'id','shop_names');
$articleDatas=ArrayHelper::map($article,'id','value');
$categoryData=ArrayHelper::map($category,'id','name');
$this->title = Yii::t('backend','CODSINSHOP');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = ' goods';

?>
<div class="godsinshop-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'id' => 'kv-grid-demo',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_img',
                'format'    =>  'raw',
                'value'     =>  function($model){
                    return $model->getImage($model->id_img);
                }
            ],
            [
                'attribute'   =>   'id_gods',
                'format'      =>    'raw',
                'value'       =>    function($model){
                    return $model->theGetGods($model);
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $godDatas,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
            ],
            [
                'attribute'   =>   'article',
                'format'      =>    'raw',
                'value'       =>    function($model){
                    return $model->theGetValue($model->article);},
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $articleDatas,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>Yii::t('backend','SELECT_ARTICLE')]
            ],
            [
                'attribute'   =>   'description',
                'format'      =>    'raw',
                'value'       =>    function($model){
                    return $model->description;}
            ],
            [
                'attribute'   =>   'category',
                'format'      =>    'raw',
                'value'       =>    function($model){
                    $name=json_decode($model->category);
                    return $name->name;},
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $categoryData,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>Yii::t('backend','SELECT_CATEGORY')]
            ],
            [
                'attribute'   =>   'have',
                'format'      =>    'raw',
                'value'       =>    function ($model){
                    return $model->getHave($model);}
            ],
            [
                'attribute'   => 'id_shop',
                'format'      =>    'raw',
                'value'       =>    function($model){
                    return $model->theGetShop($model);
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $shopDatas,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>Yii::t('backend','SELECT_SHOP')]
            ],
            [
                'attribute'     =>  'site',
                'format'        =>  'raw',
                'value'         =>  function($model){
                    return $model->theGetValue($model->site);}

            ],
            [
                'attribute'     =>  'code_provider',
                'format'        =>  'raw',
                'value'         =>  function($model){
                    return $model->theGetValue($model->code_provider);}

            ],
            [
                'attribute'     =>  'name_provider',
                'format'        =>  'raw',
                'value'         =>  function($model){
                    return $model->theGetValue($model->name_provider);}
            ],
            [
                'attribute'     =>  'contact_provider',
                'format'        =>  'raw',
                'value'         =>  function($model){
                    return $model->theGetValue($model->contact_provider);}
            ],
            [
                'attribute'     =>  'keywords',
                'format'        =>  'raw',
                'value'         =>  function($model){
                    $key=str_replace('[','',$model->keywords);
                    $keywords=str_replace(']','',$key);
                    $macthes=explode(',',$keywords);
                    $str='';
                    foreach ($macthes as $macthe){
                        $str .="<p>".$model->theGetValue($macthe)."</p>";
                    }
                    return $str;}
            ],
            [
                'attribute'     =>  'delivery',
                'format'        =>  'raw',
                'value'         =>  function($model){
                    return $model->theGetValue($model->delivery);}
            ],

            [
                'attribute'     =>  'link_site',
                'format'        =>  'raw',
                'value'         =>  function($model){
                    $href=$model->theGetValue($model->link_site);
                    $name= $model->theGetValue($model->site);
                    if($href==true) {
                        return Html::a($name,Url::to($href));
                    }else{
                        return '<span class="not-set">(не задано)</span>';
                    }
                }
            ],
            [
                'attribute'   => 'color',
                'format'      => 'raw',
                'value'       =>    function($model){
                    $color = $model->theGetValue($model->color);
                    return   "<span class='fa fa-4x fa-square' style='color:".$color." '></span> ";

                }
            ],
            [
                'attribute'   => 'size',
                'value'       =>    function($model){
                    return $model->theGetValue($model->size);
                }
            ],
            [
                'attribute' =>  'id_prise',
                'format'    =>  'raw',
                'value'     =>  function($model){
                    return $model->getPrise($model->id_prise);
                }
            ],
            [
                'attribute'   => 'country',
                'value'       =>    function($model){
                    return $model->theGetValue($model->country);
                }
            ],
            'quntity',
        ],
        'containerOptions'=>['style'=>'overflow: auto'],
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true,
        'toolbar'=> [
            ['content'=>
                Html::a(Yii::t('backend','CREATE_GODSINSHOP'), ['create'], [ 'class'=>'btn btn-success']),
                          ],
            '{export}',
            '{toggleData}',
        ],
    'export'=>[
        'fontAwesome'=>true
    ],
    'panel'=>[
        'type'=>GridView::TYPE_PRIMARY,
    ],
    'persistResize'=>false
    ]); ?>
</div>
