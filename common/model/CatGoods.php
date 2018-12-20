<?php

namespace common\model;

use Yii;

/**
 * This is the model class for table "catGoods".
 *
 * @property int $id
 * @property int $id_cat
 * @property int $id_gods
 * @property int $id_post
 */
class CatGoods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catGoods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cat'], 'required'],
            [['id_cat', 'id_gods', 'id_post'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cat' => 'Id Cat',
            'id_gods' => 'Id Gods',
            'id_post' => 'Id Post',
        ];
    }
}
