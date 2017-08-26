<?php

use yii\db\Migration;

class m170826_142944_AdminUser extends Migration
{
    public function safeUp()
    {
        $this->createTable('AdminUser', [
            'id' => $this->primaryKey(),
            'login' => $this->string(32)->notNull(),
            'password' => $this->string(60)->notNull()
        ]);

        $this->createIndex('AdminUser_login', 'AdminUser', 'login', true);

        $this->insert('AdminUser', [
            'login' => 'admin',
            'password' => \Yii::$app->security->generatePasswordHash('admin')
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('AdminUser');
    }
}
