<?php

namespace Shop\Entities;

use common\model\Goods;
use Shop\Forms\BasketForm;

/**
 * This is the model class for table "basket".
 *
 * @property int $id
 * @property int $id_goods
 * @property int $id_user
 * @property int $active
 * @property int $amount
 * @property string $color
 * @property string $size
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone
 * @property string $city
 * @property string $deliveryAddress
 * @property string $postOffice
 * @property string $comments
 * @property int $price
 * @property int $confirmed
 *
 * @property Goods $goods
 */
class Basket extends \yii\db\ActiveRecord
{
    public static function create(int $idGoods,int $userId,int $price):self
    {
        $bascet=new static();
        $bascet->id_goods = $idGoods;
        $bascet->id_user = $userId;
        $bascet->active = '1';
        $bascet->amount = '1';
        $bascet->confirmed = '0';
        $bascet->price = $price;
        return $bascet;
    }

    public static function createPostAdnCookie(BasketForm $form,array $goods):self
    {
        $bascet=new static();
        $bascet->id_goods = $form->id_goods;
        $bascet->id_user = $form->id_user;
        $bascet->confirmed = $form->confirmed;
        $bascet->price = $form->price;
        $bascet->name = $form->name;
        $bascet->surname = $form->surname;
        $bascet-> email = $form->email;
        $bascet->phone = $form->phone;
        $bascet->city = $form->city;
        $bascet->deliveryAddress = $form->deliveryAddress;
        $bascet->postOffice = $form->postOffice;
        $bascet-> comments = $form->comments;
        $bascet-> id_goods = $goods['idGoods'];
        $bascet-> id_user = '0';
        $bascet-> active = '0';
        $bascet-> amount = $goods['amount'];
        $bascet-> confirmed = '1';
        $bascet-> price = $goods['price'];
        $bascet-> color = $goods['color'];
        $bascet-> size = $goods['size'];
        return $bascet;
    }

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
            [['id_goods', 'id_user', 'active', 'amount', 'price', 'confirmed'], 'integer'],
            [['name', 'surname', 'email', 'phone', 'city', 'deliveryAddress', 'postOffice', 'comments'], 'string'],
            [['color', 'size'], 'string', 'max' => 255],
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
            'color' => 'Color',
            'size' => 'Size',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'phone' => 'Phone',
            'city' => 'City',
            'deliveryAddress' => 'Delivery Address',
            'postOffice' => 'Post Office',
            'comments' => 'Comments',
            'price' => 'Price',
            'confirmed' => 'Confirmed',
        ];
    }

    public function getGoods()
    {
        return $this->hasOne(Goods::class, ['id' => 'id_goods']);
    }
}
