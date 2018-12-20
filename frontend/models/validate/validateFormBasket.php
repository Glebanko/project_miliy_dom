<?php

namespace frontend\models\validate;
use yii\base\Model;

class validateFormBasket extends Model{
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