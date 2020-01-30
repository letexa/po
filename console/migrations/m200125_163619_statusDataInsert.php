<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\Status;

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
        'id' => Status::HANGING_STATUS,
        'alias' => 'hanging',
        'name' => 'на дереве',
    ],
    [
        'id' => Status::FALL_STATUS,
        'alias' => 'fall',
        'name' => 'упало',
    ],
    [
        'id' => Status::ROTTEN_STATUS,
        'alias' => 'rotten',
        'name' => 'гнилое',
    ],
]
        );
    }

    public function safeDown()
    {
       
    }
}
