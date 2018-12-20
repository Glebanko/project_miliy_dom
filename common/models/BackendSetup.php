<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_backendSetup".
 *
 * @property integer $id
 * @property string $name_feild
 * @property string $key_feild
 * @property string $value_feild
 */
class BackendSetup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_backendSetup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_feild', 'key_feild', 'value_feild'], 'required'],
            [['name_feild', 'key_feild'], 'string', 'max' => 255],
            [['value_feild'], 'string', 'max' => 610],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_feild' => 'Name Feild',
            'key_feild' => 'Key Feild',
            'value_feild' => 'Value Feild',
        ];
    }
}
