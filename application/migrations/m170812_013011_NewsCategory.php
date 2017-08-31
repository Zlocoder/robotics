<?php

use yii\db\Migration;

class m170812_013011_NewsCategory extends Migration
{
    public function safeUp()
    {
        $this->createTable('NewsCategory', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'slug' => $this->string(128)->notNull(),
            'h1' => $this->string(128),
            'metaTitle' => $this->string(128),
            'metaDescription' => $this->string(256),
            'redirect' => $this->string(256),
        ]);

        $this->createIndex('NewsCategory_name', 'NewsCategory', 'name', true);
        $this->createIndex('NewsCategory_slug', 'NewsCategory', 'slug', true);
    }

    public function safeDown()
    {
        $this->dropTable('NewsCategory');
    }
}
