<?php

namespace backend\models;

use common\models\Addlfeild;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Godsinshop;

/**
 * GodsinshopSearch represents the model behind the search form about `common\models\Godsinshop`.
 */
class GodsinshopSearch extends Godsinshop
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_gods', 'id_shop', 'category'], 'integer'],
            [[ 'article'], 'safe'],
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
        $query = Godsinshop::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //$article=Addlfeild::find()->where(['key_feild'=>'article','value'=>$this->article])->one();
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_gods'   =>  $this->id_gods,
            'id_shop'   =>  $this->id_shop,
            'article'   =>  $this->article,
        ]);
        /*if(isset($article)){
            $query->andFilterWhere(['article'   =>  $article->id,]);
        }*/
        $query->andFilterWhere(['like', 'category', $this->category]);
        return $dataProvider;
    }
}
