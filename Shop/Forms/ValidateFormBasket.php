<?php

namespace Shop\Forms;
use yii\base\Model;

/**
 * Class validateFormBasket
 * @package Shop\Forms
 * @property  string $name
 * @property  string $surname
 * @property  string $email;
 * @property  string $phone;
 * @property  string $city;
 * @property  string $deliveryAddress;
 * @property string $postOffice;
 * @property string $comments
 */
class ValidateFormBasket extends  Model
{
	public $name;
	public $surname;
	public $email;
	public $phone;
	public $city;
	public $deliveryAddress;
	public $postOffice;
	public $comments;

	public function rules(){
		return [
			[ ['name', 'surname', 'email', 'phone'], 'required', 'message' => 'Это поле обязательно к заполнению'],
			[['name', 'surname', 'email', 'phone'],'string'],
			['email', 'email', 'message' => 'Email введен некорректно'],
		];
	}
	public function attributeLabels(){
		return [
			'name' => 'Имя*',
			'surname' => 'Фамилия*',
			'email' => 'Email*',
			'phone' => 'Телефон*',
			'city' => 'Город',
			'deliveryAddress' => 'Адрес доставки',
			'postOffice' => 'Желаемое отделение новой почты',
			'comments' => 'Комментарий'
		];
	}
}
?>
