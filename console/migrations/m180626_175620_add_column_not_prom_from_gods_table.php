<?php

use yii\db\Migration;
use common\models\Gods;
/**
 * Class m180626_175620_add_column_not_prom_from_gods_table
 */
class m180626_175620_add_column_not_prom_from_gods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Gods::tableName(),'not_prom',$this->boolean()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Gods::tableName(),'not_prom');
    }
}
