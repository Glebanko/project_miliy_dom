<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','IMAGES');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="image-index">

    <h2><?php if($cat){ ?>
        <h2><?=Html::a($goods->name,Url::to(['/gods/index','GodsSearch[title]'=>$goods->name])); ?></h2>
    <?php } else { ?>
        <h2><?=Html::a($goods->title,Url::to(['/gods/index','GodsSearch[title]'=>$goods->title])); ?></h2>
    <?php } ?>
    </h2>
    <p>
        <?= Html::a(Yii::t('backend','CREATEIMAGE'), Url::to(['/image/create','id'=>$id,'goods_id'=>$id_goods,'feild'=>$class,'basefeild'=>$feild]), ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <div class="box">
        <div class="box=body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['class' => 'yii\grid\ActionColumn'],
                    [
                        'attribute'=>'image',
                        'header'=> Yii::t('backend','IMAGE'),
                        'format'=>'raw',
                        'value'=>function($model){
                            return Html::img(Yii::getAlias('@frontendWebroot') . '/image/'. $model->path .  $model->name,['height'=>100]);
                        }
                    ],
                    [
                        'attribute'=>'id_gods',
                        'format'=>'raw',
                        'value'=>function($model){
                            if(isset($model->id_gods))
                                return $model->goods->title;
                            return false;
                        }
                    ],
                    [
                        'attribute'=>'id_cat',
                        'format'=>'raw',
                        'value'=>function($model){
                            if(isset($model->id_cat))
                                return $model->goods->name;
                            return false;
                        }
                    ],
                    [
                        'attribute'=>'id_post',
                        'format'=>'raw',
                        'value'=>function($model){
                            if(isset($model->id_post))
                                return $model->post->title;
                            return false;
                        }
                    ],
                    'path',
                    'name',
                    [
                        'attribute'   =>   'forHome',
                        'header'      =>    Yii::t('backend','forHomes'),
                        'format'    =>  'raw',
                        'value'     =>  function($model){
                            if($model->forHome==1)
                                return Yii::t('backend','forHome');
                        }
                    ],
                    [
                        'attribute'   =>   'forFancy',
                        'header'      =>    Yii::t('backend','forFancys'),
                        'format'    =>  'raw',
                        'value'     =>  function($model){
                            if($model->forFancy==1)
                                return Yii::t('backend','forFancy');
                        }
                    ],


                ],
            ]); ?>
        </div>
    </div>

<?php Pjax::end(); ?></div>
