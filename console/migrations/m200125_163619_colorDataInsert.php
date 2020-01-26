<?php

use yii\db\Schema;
use yii\db\Migration;

class m200125_163619_colorDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%color}}',
                           ["id", "alias", "name"],
                            [
    [
        'id' => '1',
        'alias' => 'green',
        'name' => 'зеленое',
    ],
    [
        'id' => '2',
        'alias' => 'red',
        'name' => 'красное',
    ],
    [
        'id' => '3',
        'alias' => 'yelow',
        'name' => 'желтое',
    ],
    [
        'id' => '4',
        'alias' => 'red-green',
        'name' => 'красно-зеленое',
    ],
]
        );
    }

    public function safeDown()
    {
        
    }
}
