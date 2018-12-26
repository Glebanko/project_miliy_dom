<?php

use yii\db\Migration;
use common\models\Gods;
/**
 * Class m180501_103914_add_collumn_wholesale_and_wholesale_price_from_goods
 */
class m180501_103914_add_collumn_wholesale_and_wholesale_price_from_goods extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Gods::tableName(),'wholesale',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn(Gods::tableName(),'wholesale');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180501_103914_add_collumn_wholesale_and_wholesale_price_from_goods cannot be reverted.\n";

        return false;
    }
    */
}
