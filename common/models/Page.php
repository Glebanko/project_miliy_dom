<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_page".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug_page
 * @property string $description_page
 */
class Page extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_page';
    }
    public function getAddfeilds(){
        return $this->hasMany(Addlfeild::className(),['id_page'=>'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description_page'], 'required'],
            [['title', 'slug_page'], 'string', 'max' => 255],
            [['description_page','image'], 'string', 'max' => 50000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('backend','TITLEPAGE'),
            'slug_page' => Yii::t('backend','SLUG_PAGE'),
            'description_page' => Yii::t('backend','DESCRIPTION_PAGE'),
        ];
    }
}
