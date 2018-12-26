<?php

namespace Shop\Forms;

use Shop\Entities\Basket;
use yii\base\Model;

/**
 * Class BasketForm
 * @package Shop\Forms
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
 */
class BasketForm extends Model
{
    public $id;
    public $id_goods;
    public $id_user;
    public $active;
    public $amount;
    public $color;
    public $size;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $city;
    public $deliveryAddress;
    public $postOffice;
    public $comments;
    public $price;
    public $confirmed;

    public function __construct(Basket $basket=null, $config = [])
    {
        parent::__construct($config);
        if($basket){
            $this->id= $basket->id;
            $this->id_goods= $basket->id_goods;
            $this->id_user= $basket->id_user;
            $this->active= $basket->active;
            $this->amount= $basket->amount;
            $this->color= $basket->color;
            $this->size= $basket->size;
            $this->name= $basket->name;
            $this->surname= $basket->surname;
            $this->email= $basket->email;
            $this->phone= $basket->phone;
            $this->city= $basket->city;
            $this->deliveryAddress= $basket->deliveryAddress;
            $this->postOffice= $basket->postOffice;
            $this->comments= $basket->comments;
            $this->price= $basket->price;
            $this->confirmed= $basket->confirmed;
        }
    }

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

}
