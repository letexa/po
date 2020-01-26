<?php

use yii\db\Schema;
use yii\db\Migration;

class m200125_161022_apple extends Migration
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
            '{{%apple}}',
            [
                'id'=> $this->integer(11)->notNull(),
                'color_id'=> $this->integer(11)->notNull(),
                'status_id'=> $this->integer(11)->notNull(),
                'size'=> $this->integer(3)->notNull()->defaultValue(100),
                'createdate'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'updatedate'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            ],$tableOptions
        );
        $this->createIndex('color_id','{{%apple}}',['color_id'],false);
        $this->createIndex('status_id','{{%apple}}',['status_id'],false);

        $this->addForeignKey('fk_apple_color_id',
            '{{%apple}}','color_id',
            '{{%color}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_apple_status_id',
            '{{%apple}}','status_id',
            '{{%status}}','id',
            'CASCADE','CASCADE'
         );

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_apple_color_id', '{{%apple}}');
        $this->dropForeignKey('fk_apple_status_id', '{{%apple}}');
        $this->dropIndex('color_id', '{{%apple}}');
        $this->dropIndex('status_id', '{{%apple}}');
        $this->dropTable('{{%apple}}');
    }
}
