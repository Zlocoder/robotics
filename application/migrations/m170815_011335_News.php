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
            'created' => $this->dateTime()->notNull(),
            'textShort' => $this->text()->notNull(),
            'textHelp' => $this->text()->notNull(),
            'textFull' => $this->text()->notNull(),
            'h1' => $this->string(128),
            'image' => $this->string(16),
            'imageText' => $this->string(256),
            'metaTitle' => $this->string(128),
            'metaDescription' => $this->string(256),
            'tags' => $this->string(256),
            'redirect' => $this->string(256),
        ]);

        $this->createIndex('News_title', 'news', 'title', true);
        $this->createIndex('News_slug', 'news', 'slug', true);

        $this->addForeignKey('News_categoryId_FK', 'News', 'categoryId', 'NewsCategory', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('News');
    }
}
