<?php

namespace common\model;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property int $id_gods
 * @property int $id_post
 * @property int $id_cat
 * @property int $id_page
 * @property string $path
 * @property string $name
 * @property int $forHome
 * @property int $forFancy
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_gods', 'id_post', 'id_cat', 'id_page', 'forHome', 'forFancy'], 'integer'],
            [['path', 'name'], 'required'],
            [['path', 'name'], 'string', 'max' => 610],
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
            'id_post' => 'Id Post',
            'id_cat' => 'Id Cat',
            'id_page' => 'Id Page',
            'path' => 'Path',
            'name' => 'Name',
            'forHome' => 'For Home',
            'forFancy' => 'For Fancy',
        ];
    }
}
