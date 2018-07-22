<?php


use Phinx\Migration\AbstractMigration;

class CreateArticleExternal extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('article_external');
    }

    public function change()
    {
        $table = $this->table('article_external', ['id' => false, 'primary_key' => ['uid']]);

        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('type',  'string', ['limit' => 16])
            ->addColumn('title',  'string', ['limit' => 255])
            ->addColumn('text_lead',  'string', ['limit' => 255])
            ->addColumn('image',  'string', ['limit' => 255])
            ->addColumn('publisher_url', 'string', ['limit' => 255])
            ->addColumn('publisher_name', 'string', ['limit' => 64])
            ->addColumn('link_url', 'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
