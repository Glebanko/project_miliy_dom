<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Addlfeild;

/**
 * AddlfeildSearch represents the model behind the search form about `common\models\Addlfeild`.
 */
class AddlfeildSearch extends Addlfeild
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','id_cat', 'id_gods', 'id_post'], 'integer'],
            [['key_feild', 'value'], 'safe'],
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
        if(Yii::$app->user->can('canViewsSite')){
        $query = Addlfeild::find();
        }else{
        $query = Addlfeild::find()->where(['not in','key_feild', ['site','link_site']]);
        }

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_cat'  => $this->id_cat,
            'id_gods' => $this->id_gods,
            'id_post' => $this->id_post,
        ]);

        $query->andFilterWhere(['like', 'key_feild', $this->key_feild])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
