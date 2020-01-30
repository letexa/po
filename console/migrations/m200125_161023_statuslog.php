<?php

use yii\db\Schema;
use yii\db\Migration;

class m200125_161023_statuslog extends Migration
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
                'apple_id'=> $this->integer(11)->notNull(),
                'status_id'=> $this->integer(11)->notNull(),
                'updatedate'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            ],$tableOptions
        );
        $this->createIndex('apple','{{%statuslog}}',['apple_id'],false);
        $this->createIndex('status_id','{{%statuslog}}',['status_id'],false);

        $this->addForeignKey('fk_statuslog_status_id',
            '{{%statuslog}}','status_id',
            '{{%status}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_statuslog_apple_id',
            '{{%statuslog}}','apple_id',
            '{{%apple}}','id',
            'CASCADE','CASCADE'
         );

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_statuslog_status_id', '{{%statuslog}}');
        $this->dropForeignKey('fk_statuslog_apple_id', '{{%statuslog}}');
        $this->dropIndex('apple', '{{%statuslog}}');
        $this->dropIndex('status_id', '{{%statuslog}}');
        $this->dropTable('{{%statuslog}}');
    }
}
