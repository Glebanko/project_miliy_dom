<?php

namespace common\model;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $title
 * @property string $slug_gods
 * @property string $discription_gods
 * @property string $quote
 * @property string $url
 * @property int $id_prise
 * @property int $have
 * @property int $price_selling
 * @property int $user_id
 * @property int $sets
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug_gods', 'discription_gods', 'quote', 'id_prise', 'have', 'user_id'], 'required'],
            [['discription_gods'], 'string'],
            [['id_prise', 'have', 'price_selling', 'user_id', 'sets'], 'integer'],
            [['title', 'slug_gods'], 'string', 'max' => 510],
            [['quote'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 610],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug_gods' => 'Slug Gods',
            'discription_gods' => 'Discription Gods',
            'quote' => 'Quote',
            'url' => 'Url',
            'id_prise' => 'Id Prise',
            'have' => 'Have',
            'price_selling' => 'Price Selling',
            'user_id' => 'User ID',
            'sets' => 'Sets',
        ];
    }
    public function getimage()
    {
        return $this->hasMany(Image::className(), ['id_gods' => 'id']);
    }
    public function getarticle()
    {
        return $this->hasOne(Article::className(), ['id_gods' => 'id']);
    }
    public function getprice()
    {
        return $this->hasOne(Price::className(), ['id' => 'id_prise']);
    }
    public function getsize()
    {
        return $this->hasMany(Size::className(), ['id_gods' => 'id']);
    }
    public function getcolor()
    {
        return $this->hasMany(Color::className(), ['id_gods' => 'id']);
    }
    public function getinfo()
    {
        return $this->hasMany(infoGoods::className(), ['id_gods' => 'id']);
    }
}
