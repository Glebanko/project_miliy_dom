<?php

use yii\db\Migration;
use common\models\FrontendSetup;
/**
 * Handles the creation of table `xml_date`.
 */
class m180512_191326_create_xml_date_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('abh_xml_date', [
            'id' => $this->primaryKey(),
            'id_xml'=>$this->integer(),
            'date'=>$this->integer()
        ]);
        $this->createIndex('idx_xml','abh_xml_date','id');
        $this->addForeignKey('fk_xml_data','abh_xml_date','id_xml',FrontendSetup::tableName(),'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_xml_data','xml_data');
        $this->dropIndex('idx_xml','xml_date');
        $this->dropTable('abh_xml_date');
    }
}
