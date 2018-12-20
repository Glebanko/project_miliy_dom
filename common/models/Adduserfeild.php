<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_adduserfeild".
 *
 * @property integer $id
 * @property string $avatar
 * @property string $name
 * @property string $tel
 * @property string $email
 * @property integer $id_user
 */
class Adduserfeild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_adduserfeild';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',  'id_user'], 'required'],
            [['id_user'], 'integer'],
            [['avatar','adrres'], 'string', 'max' => 510],
            [['name', 'tel', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'avatar' => Yii::t('app','AVATAR'),
            'name'  =>  Yii::t('app','NAME'),
            'tel'   =>  Yii::t('app','TEL'),
            'adrres'=> Yii::t('app','ADRES'),
            'email' => Yii::t('app','EMAIL'),
            'id_user' => Yii::t('app','IDUSER'),
        ];
    }
}
