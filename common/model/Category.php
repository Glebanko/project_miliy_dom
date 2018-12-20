<?php

namespace common\model;

use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $slug_category
 * @property string $description_category
 * @property int $parrent_category
 * @property string $modulcategory
 * @property string $quote
 * @property string $size
 * @property string $templates
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static $exceptionCat=array(
        'Доставка и оплата',
        'Контакты',
        'Новая',
        'Рекомендуемые',
        'Под заказ',
        'Новости',
        'Отзывы');
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parrent_category'], 'integer'],
            [['name', 'slug_category', 'modulcategory', 'quote', 'size'], 'string', 'max' => 255],
            [['description_category'], 'string', 'max' => 5000],
            [['templates'], 'string', 'max' => 610],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug_category' => 'Slug Category',
            'description_category' => 'Description Category',
            'parrent_category' => 'Parrent Category',
            'modulcategory' => 'Modulcategory',
            'quote' => 'Quote',
            'size' => 'Size',
            'templates' => 'Templates',
        ];
    }
    public function getParent()
    {
        return $this->hasMany(Category::className(), ['parrent_category' => 'id']);
    }
    public function getHit(){
        return $this->hasMany(Goods::className(),['id'=>'id_gods'])->viaTable('catGoods', ['id_cat' => 'id'])->orderBy(new Expression('rand()'))->limit(6)->where(['have'=>0]);
    }
    public function getSell(){
        return $this->hasMany(Goods::className(),['id'=>'id_gods'])->viaTable('catGoods', ['id_cat' => 'id'])->orderBy(new Expression('rand()'))->limit(6)->where(['have'=>0])->andWhere(['>', 'price_selling', 0]);
    }
    public function getGoods(){
        return $this->hasMany(Goods::className(),['id'=>'id_gods'])->viaTable('catGoods', ['id_cat' => 'id'])->where(['have'=>0]);
    }
}
