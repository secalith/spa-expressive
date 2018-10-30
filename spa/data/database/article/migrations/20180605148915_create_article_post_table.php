<?php


use Phinx\Migration\AbstractMigration;

class CreateArticlePostTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('article_post');
    }

    public function change()
    {
        $table = $this->table('article_post', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('article_uid',  'string', ['limit' => 64])
            ->addColumn('title', 'string', ['limit' => 255])
            ->addColumn('title_global', 'string', ['limit' => 255])
            ->addColumn('abstract', 'string', ['null' => true])
            ->addColumn('lead', 'string', ['null' => true])
            ->addColumn('text', 'string', ['null' => true])
            ->addColumn('language', 'string', ['limit' => 8])
            ->addColumn('file', 'string', ['null' => true])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
