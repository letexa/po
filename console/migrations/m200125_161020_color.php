<?php

use yii\db\Schema;
use yii\db\Migration;

class m200125_161020_color extends Migration
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
            '{{%color}}',
            [
                'id'=> $this->primaryKey(11),
                'alias'=> $this->string(255)->notNull(),
                'name'=> $this->string(255)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%color}}');
    }
}
