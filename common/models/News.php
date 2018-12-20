<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_post".
 *
 * @property integer $id
 * @property string $title
 * @property string $text1
 * @property string $text2
 * @property string $text3
 * @property string $text4
 * @property string $text5
 * @property string $text6
 * @property string $text7
 * @property integer $news
 * @property string $img1
 * @property string $img2
 * @property string $img3
 * @property string $img4
 * @property string $img5
 * @property string $img6
 * @property string $img7
 * @property string $data
 */
class News extends \yii\db\ActiveRecord
{
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
    public function rules()
    {
        return [
            [['title', 'text1', 'text2', 'text3', 'text4', 'text5', 'text6', 'text7', 'news', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'data'], 'required'],
            [['text1', 'text2', 'text3', 'text4', 'text5', 'text6', 'text7'], 'string'],
            [['news'], 'integer'],
            [['data'], 'safe'],
            [['title', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text1' => 'Text1',
            'text2' => 'Text2',
            'text3' => 'Text3',
            'text4' => 'Text4',
            'text5' => 'Text5',
            'text6' => 'Text6',
            'text7' => 'Text7',
            'news' => 'News',
            'img1' => 'Img1',
            'img2' => 'Img2',
            'img3' => 'Img3',
            'img4' => 'Img4',
            'img5' => 'Img5',
            'img6' => 'Img6',
            'img7' => 'Img7',
            'data' => 'Data',
        ];
    }
}
