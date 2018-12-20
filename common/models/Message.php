<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_message".
 *
 * @property integer $id
 * @property string $id_user
 * @property string $title
 * @property string $description
 * @property integer $create_at
 * @property integer $type
 * @property integer $question
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'title', 'description', 'create_at', 'type', 'question'], 'required'],
            [['id', 'create_at', 'type', 'question'], 'integer'],
            [['id_user', 'description'], 'string', 'max' => 610],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function getUser($id){
        $user= User::find()->where(['id'=>$id])->all();
        if(isset($user)){
            return $user->username;
        }else{
            return $id;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' =>Yii::t('backend','USER'),
            'title' => Yii::t('backend','TITLE_MESSAGE'),
            'description' => Yii::t('backend','DESCRIPTION_MESSAGE'),
            'create_at' => Yii::t('backend','CREATE_AT'),
            'type' => 'Type',
            'question' => 'Question',
        ];
    }
}
