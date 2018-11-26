<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "basket".
 *
 * @property int $id
 * @property int $id_goods
 * @property int $id_user
 * @property int $active
 * @property int $amount
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'basket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_goods', 'id_user', 'active', 'amount'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_goods' => 'Id Goods',
            'id_user' => 'Id User',
            'active' => 'Active',
            'amount' => 'Amount',
        ];
    }
}
