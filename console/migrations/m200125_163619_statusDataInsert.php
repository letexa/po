<?php

use yii\db\Schema;
use yii\db\Migration;

class m200125_163619_statusDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%status}}',
                           ["id", "alias", "name"],
                            [
    [
        'id' => '1',
        'alias' => 'hanging',
        'name' => 'на дереве',
    ],
    [
        'id' => '2',
        'alias' => 'fall',
        'name' => 'упало',
    ],
    [
        'id' => '3',
        'alias' => 'rotten',
        'name' => 'гнилое',
    ],
    [
        'id' => '4',
        'alias' => 'eaten',
        'name' => 'съедено',
    ],
]
        );
    }

    public function safeDown()
    {
       
    }
}
