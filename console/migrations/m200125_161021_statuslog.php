<?php

use yii\db\Schema;
use yii\db\Migration;

class m200125_161021_statuslog extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%statuslog}}',
            [
                'id'=> $this->primaryKey(11),
                'old_status_id'=> $this->integer(11)->notNull(),
                'new_status_id'=> $this->integer(11)->notNull(),
                'updatedate'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            ],$tableOptions
        );
        $this->createIndex('old','{{%statuslog}}',['old_status_id'],false);
        $this->createIndex('new_status_id','{{%statuslog}}',['new_status_id'],false);

        $this->addForeignKey('fk_statuslog_new_status_id',
            '{{%statuslog}}','new_status_id',
            '{{%status}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_statuslog_old_status_id',
            '{{%statuslog}}','old_status_id',
            '{{%status}}','id',
            'CASCADE','CASCADE'
         );

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_statuslog_new_status_id', '{{%statuslog}}');
        $this->dropForeignKey('fk_statuslog_old_status_id', '{{%statuslog}}');
        $this->dropIndex('old', '{{%statuslog}}');
        $this->dropIndex('new_status_id', '{{%statuslog}}');
        $this->dropTable('{{%statuslog}}');
    }
}
