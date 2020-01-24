<?php

use yii\db\Schema;
use yii\db\Migration;

class m200124_183936_userDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%user}}',
                           ["id", "username", "auth_key", "password_hash", "password_reset_token", "email", "status", "created_at", "updated_at", "verification_token"],
                            [
    [
        'id' => '3',
        'username' => 'admin',
        'auth_key' => 'QDA6fSCM-No-GAS-aXkun0Ntm5Pyv1DD',
        'password_hash' => '$2y$13$x1/JLvrZ/e9BaYpM4Uo.9ORhEhm9gbRmdK6XizTwc3tiykeS83.Ee',
        'password_reset_token' => null,
        'email' => 'admin@po.loc',
        'status' => '10',
        'created_at' => '1579889835',
        'updated_at' => '1579889835',
        'verification_token' => '0WbK5tQJl4RdOJazF0zEsvnP2ej3i5cS_1579889835',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%user}} CASCADE');
    }
}
