<?php

use yii\db\Migration;
use common\models\User;
/**
 * Class m180915_202615_add_bonus_colomn_from_user_table
 */
class m180915_202615_add_bonus_colomn_from_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
       $this->addColumn(User::tableName(),'number_bonus',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropColumn(User::tableName(),'number_bonus');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180915_202615_add_bonus_colomn_from_user_table cannot be reverted.\n";

        return false;
    }
    */
}
