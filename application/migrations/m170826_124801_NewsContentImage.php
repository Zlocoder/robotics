<?php

use yii\db\Migration;

class m170826_124801_NewsContentImage extends Migration
{
    public function safeUp()
    {
        $this->createTable('NewsContentImage', [
            'newsId' => $this->integer()->notNull(),
            'image' => $this->string(32)->notNull()
        ]);

        $this->addForeignKey('NewsContentImage_newsId_FK', 'NewsContentImage', 'newsId', 'News', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('NewsContentImage');
    }
}
