<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.06.17
 * Time: 21:56
 */

namespace backend\models;


class User extends \common\models\User
{
    public $cookie;
    public function rules()
    {
        return [
            [['created_at', 'updated_at','discount','percent'], 'integer'],
            [['name', 'tel', 'cookie','adress'], 'string', 'max' => 510],
            [['email','famaly','officeNewPost','sity'], 'string', 'max' => 255],
        ];
    }
}