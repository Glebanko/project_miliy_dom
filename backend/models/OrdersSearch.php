<?php

namespace backend\models;

use common\models\Addlfeild;
use common\models\Gods;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `common\models\Orders`.
 */
class OrdersSearch extends Orders
{
    public $article;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'datetime', 'user_id', 'anonim_id', 'received_sell'], 'integer'],
            [['article'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Orders::find()->where(['or',['not',['user_id'=>null]],['not',['anonim_id'=>null]]])->orderBy(['datetime'=>SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $orders=array();
        if(isset($params['OrdersSearch']['article'])){
            if($params['OrdersSearch']['article']!=''){
                $id_goods=Addlfeild::find()->where(['id'=>$params['OrdersSearch']['article']])->select('id_gods')->all();
                $goods_id=array();
                foreach ($id_goods as $id){
                    $goods_id[]=$id->id_gods;
                }
                $goods=Gods::find()->where(['in','id',$goods_id])->all();

                foreach ($goods as $good){
                    foreach ( $good->orders as $order){
                        $orders[]=$order->id;
                    }
                }
            }
        }
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'datetime' => $this->datetime,
            'user_id' => $this->user_id,
            'anonim_id' => $this->anonim_id,
        ]);
        if(!empty($params["OrdersSearch"]["received_sell"])){
             if($params["OrdersSearch"]["received_sell"]==5){
                $query->andFilterWhere(['in','received_sell', [0,1,2,3,4]]);
            }else{
                $query->andFilterWhere([
                'received_sell' => $params["OrdersSearch"]["received_sell"]]);
            }
        }
       
        if(isset($orders)) {
            $query->andFilterWhere(['in','id', $orders]);
        }

        return $dataProvider;
    }
}
