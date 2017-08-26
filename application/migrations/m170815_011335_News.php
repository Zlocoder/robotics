<?php

use yii\db\Migration;

class m170815_011335_News extends Migration
{
    public function safeUp()
    {
        $this->createTable('News', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'slug' => $this->string(128)->notNull(),
            'categoryId' => $this->integer()->notNull(),
            'categories' => $this->string(128)->notNull(),
            'created' => $this->dateTime()->notNull(),
            'textShort' => $this->text()->notNull(),
            'textFull' => $this->text()->notNull(),
            'h1' => $this->string(128),
            'image' => $this->string(16),
            'imageText' => $this->string(256),
            'metaTitle' => $this->string(128),
            'metaDescription' => $this->string(256),
            'tags' => $this->string(256),
            'redirect' => $this->string(256),
        ]);

        $this->createIndex('News_categoryId_title', 'news', ['categoryId', 'title'], true);
        $this->createIndex('News_categoryId_slug', 'news', ['categoryId', 'slug'], true);

        $this->addForeignKey('News_categoryId_FK', 'news', 'categoryId', 'newsCategory', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('News');
    }
}
