<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_basket".
 *
 * @property integer $id
 * @property integer $goodsid
 * @property integer $user_id
 * @property integer $anonim_id
 * @property string $customer
 * @property integer $quantity
 * @property integer $size
 * @property integer $color
 * @property integer $price
 * @property integer $datetime
 * @property integer $order_id
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_basket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsid',  'quantity', 'datetime'], 'required'],
            [['goodsid', 'user_id',  'quantity', 'color', 'price', 'datetime', 'order_id','elastic'], 'integer'],
            [['size'],'safe'],
            [['customer'], 'string', 'max' => 150],
            [['anonim_id',], 'string', 'max' => 1000],
        ];
    }
    public function getGods(){
        return $this->hasOne(Gods::className(),['id'=>'goodsid']);
    }

    public function getColors(){
        return $this->hasOne(Addlfeild::className(),['id'=>'color']);
    }

    public function getSizes()
    {
        return $this->hasOne(Addlfeild::className(),['id'=>'size']);
    }
    public function getPrises(){
        return $this->hasOne(Prise::className(),['id'=>'price']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsid' => 'Goodsid',
            'user_id' => 'User ID',
            'anonim_id' => 'Anonim ID',
            'customer' => 'Customer',
            'quantity' => 'Quantity',
            'size' => 'Size',
            'color' => 'Color',
            'price' => 'Price',
            'datetime' => 'Datetime',
            'order_id' => 'Order ID',
        ];
    }
}
