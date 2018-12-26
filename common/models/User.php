<?php
namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends \dektrium\user\models\User//extends ActiveRecord implements IdentityInterface
{



    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return ArrayHelper::merge($scenarios, [
            'settings' => ['username', 'email', 'password','adress','name','tel','avatar','officeNewPost','famaly','sity',],
        ]);
    }


    public function rules()
    {
        $rules = parent::rules();
        $rules['adressLength']   = ['adress', 'string', 'max' => 510];
        $rules['nameLength']   = ['name', 'string', 'max' => 255];
        $rules['officeNewPostLength']   = ['officeNewPost', 'string', 'max' => 255];
        $rules['famalyLength']   = ['famaly', 'string', 'max' => 255];
        $rules['sityLength']   = ['sity', 'string', 'max' => 255];
        $rules['telLength']   = ['tel', 'string'];
        $rules['avatarLength']   = ['avatar', 'string', 'max' => 510];
        $rules['numberBonus']   = ['number_bonus', 'integer',];
        return $rules;
    }
    public static function primaryKey()
    {
        return ['auth_key'];
    }

}
