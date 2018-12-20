<?php

namespace common\model;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property int $id_gods
 * @property string $article
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_gods'], 'integer'],
            [['article'], 'required'],
            [['article'], 'string'],
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
            'article' => 'Article',
        ];
    }
}
