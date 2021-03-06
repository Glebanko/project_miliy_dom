<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "abh_xml_date".
 *
 * @property int $id
 * @property int $id_xml
 * @property int $date
 *
 * @property FrontendSetup $xml
 */
class XmlDate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'abh_xml_date';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_xml', 'date'], 'integer'],
            [['id_xml'], 'exist', 'skipOnError' => true, 'targetClass' => FrontendSetup::class, 'targetAttribute' => ['id_xml' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {


        $this->date=date('W',time());
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_xml' => 'Id Xml',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXml()
    {
        return $this->hasOne(FrontendSetup::class, ['id' => 'id_xml']);
    }
}
