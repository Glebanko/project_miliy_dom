<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_prise".
 *
 * @property integer $id
 * @property string $sites
 * @property string $addtional
 * @property integer $price1
 * @property integer $price2
 * @property integer $priceEvro
 * @property integer $priceSem
 * @property integer $wholesale
 * @property integer $created_at
 * @property integer $upedate_at
 */
class Prise extends \yii\db\ActiveRecord
{
    const PRICE1 = 'price1';
    const PRICE2 = 'price2';
    const PRICEEVRO = 'priceEvro';
    const PRICESEM = 'priceSem';

    public static $price_size = [
        'size1'=>self::PRICE1,
        'size2'=>self::PRICE2,
        'size3'=>self::PRICEEVRO,
        'size4'=>self::PRICESEM
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_prise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price1'], 'required'],
            [['price1', 'price2', 'priceEvro', 'priceSem', 'wholesale', 'created_at', 'upedate_at','whosales_id'], 'integer'],
            [['sites', 'addtional','name'], 'string', 'max' => 255],
        ];
    }

    public function getGods(){
        return $this->hasMany(Gods::className(),['id_prise'=>'id']);
    }

    public function getTablesize(){
        return $this->hasMany(FrontendSetup::className(),['key_setup'=>'sites']);
    }

    public function getPrices($size){
        if($size)
            $key=self::$price_size[$size];
        else
            $key=self::$price_size['size1'];
        return $this->$key;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sites' => 'Sites',
            'name'          =>  Yii::t('backend','NAMEPRICE'),
            'addtional'     =>  Yii::t('backend','ADDPRISE'),
            'price1'        =>  Yii::t('backend','PRICE1'),
            'price2'        =>  Yii::t('backend','PRICE2'),
            'priceEvro'     =>  Yii::t('backend','PRICEEVRO'),
            'priceSem'      =>  Yii::t('backend','PRICE_SEM'),
            'wholesale'     =>  Yii::t('backend','WHOSELES'),
            'created_at'    => 'Created At',
            'upedate_at'    => 'Upedate At',
            'whosales_id'   =>  Yii::t('backend','WHOSELESID')
        ];
    }
}
