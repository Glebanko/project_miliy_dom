<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_rating".
 *
 * @property integer $id
 * @property integer $id_gods
 * @property integer $quantity
 * @property integer $id_user
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'quantity', 'id_user'], 'required'],
            [['id_gods', 'quantity', 'id_user'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_gods' => 'Id Gods',
            'quantity' => 'Quantity',
            'id_user' => 'Id User',
        ];
    }
}
