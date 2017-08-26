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
            'parentId' => $this->integer(),
            'parents' => $this->string(128),
            'h1' => $this->string(128),
            'metaTitle' => $this->string(128),
            'metaDescription' => $this->string(256),
            'redirect' => $this->string(256),
        ]);

        $this->createIndex('NewsCategory_parentId_name', 'newsCategory', ['parentId', 'name'], true);
        $this->createIndex('NewsCategory_parentId_slug', 'newsCategory', ['parentId', 'slug'], true);

        $this->addForeignKey('NewsCategory_parentId_FK', 'newsCategory', 'parentId', 'newsCategory', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('NewsCategory');
    }
}
