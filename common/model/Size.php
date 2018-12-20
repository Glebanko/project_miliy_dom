<?php

namespace common\model;

use Yii;

/**
 * This is the model class for table "size".
 *
 * @property int $id
 * @property int $id_cat
 * @property int $id_gods
 * @property int $id_post
 * @property int $id_page
 * @property string $key_feild
 * @property string $good
 */
class Size extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'size';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cat', 'id_gods', 'id_post', 'id_page'], 'integer'],
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
            'id_cat' => 'Id Cat',
            'id_gods' => 'Id Gods',
            'id_post' => 'Id Post',
            'id_page' => 'Id Page',
            'key_feild' => 'Key Feild',
            'value' => 'Value',
        ];
    }
}
