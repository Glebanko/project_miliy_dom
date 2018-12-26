<?php

use yii\db\Migration;
use common\models\Gods;
/**
 * Class m180720_182007_add_column_alt_from_god_table
 */
class m180720_182007_add_column_alt_from_god_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Gods::tableName(),'alt',$this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn(Gods::tableName(),'alt');
    }


}
