<?php

use yii\db\Migration;
use common\models\Gods;
use common\models\User;
/**
 * Class m180801_183227_add_column_autor_id_from_gods_table
 */
class m180801_183227_add_column_autor_id_from_gods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Gods::tableName(),'author_id',$this->integer());

        $this->createIndex(
            'idx-goods-author_id',
            Gods::tableName(),
            'author_id');

        $this->addForeignKey(
            'fk-gods-author_id',
            Gods::tableName(),
            'author_id',
            User::tableName(),
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropForeignKey('fk-gods-author_id',Gods::tableName());
       $this->dropIndex('idx-goods-author_id', Gods::tableName());
       $this->dropColumn(Gods::tableName(),'autor_id');
    }

}
