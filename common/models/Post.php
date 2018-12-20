<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_post".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug_post
 * @property string $description_post
 * @property string $quote
 * @property integer $news
 * @property string $data
 */
class Post extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_post';
    }

    /**
     * @inheritdoc
     */

    public function getImages(){
        return $this->hasMany(Image::className(),['id_post'=>'id']);
    }

    public function getAddfeilds(){
        return $this->hasMany(Addlfeild::className(),['id_post'=>'id']);
    }


    public function rules()
    {
        return [
            [['title', 'description_post', 'quote', 'news', 'data'], 'required'],
            [['news'], 'integer'],
            [['data'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['slug_post', 'quote'], 'string', 'max' => 610],
            [['description_post'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('backend','TITLEPOST'),
            'slug_post' => Yii::t('backend','SLUGPOST'),
            'description_post' => Yii::t('backend','DESCRIPTIONPOST'),
            'quote' => Yii::t('backend','QUOTE'),
            'news' => Yii::t('backend','NEWSPOST'),
            'data' => Yii::t('backend','DATAPOST'),
        ];
    }
}
