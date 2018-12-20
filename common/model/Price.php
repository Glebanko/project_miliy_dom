<?php

namespace common\model;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property string $sites
 * @property string $name
 * @property string $addtional
 * @property int $price1
 * @property int $price2
 * @property int $priceEvro
 * @property int $priceSem
 * @property int $wholesale
 * @property int $whosales_id
 * @property int $created_at
 * @property int $upedate_at
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sites', 'created_at'], 'required'],
            [['price1', 'price2', 'priceEvro', 'priceSem', 'wholesale', 'whosales_id', 'created_at', 'upedate_at'], 'integer'],
            [['sites', 'name', 'addtional'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sites' => 'Sites',
            'name' => 'Name',
            'addtional' => 'Addtional',
            'price1' => 'Price1',
            'price2' => 'Price2',
            'priceEvro' => 'Price Evro',
            'priceSem' => 'Price Sem',
            'wholesale' => 'Wholesale',
            'whosales_id' => 'Whosales ID',
            'created_at' => 'Created At',
            'upedate_at' => 'Upedate At',
        ];
    }
}
