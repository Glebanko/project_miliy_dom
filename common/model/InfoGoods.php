<?php

namespace common\model;

use Yii;

/**
 * This is the model class for table "infoGoods".
 *
 * @property int $id
 * @property int $id_gods
 * @property string $key_feild
 * @property string $value
 */
class InfoGoods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'infoGoods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_gods'], 'integer'],
            [['key_feild', 'value'], 'required'],
            [['value'], 'string'],
            [['key_feild'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_gods' => 'Id Gods',
            'key_feild' => 'Key Feild',
            'value' => 'Value',
        ];
    }
}
