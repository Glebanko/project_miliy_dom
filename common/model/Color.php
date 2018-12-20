<?php

namespace common\model;

use Yii;

/**
 * This is the model class for table "color".
 *
 * @property int $id
 * @property int $id_gods
 * @property string $color
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'color';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_gods'], 'integer'],
            [['color'], 'required'],
            [['color'], 'string'],
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
            'color' => 'Color',
        ];
    }
}
