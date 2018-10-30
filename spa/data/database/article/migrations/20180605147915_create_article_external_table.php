<?php


use Phinx\Migration\AbstractMigration;

class CreateArticleExternalTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('article_external');
    }

    public function change()
    {
        $table = $this->table('article_external', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('article_uid',  'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('name_global', 'string', ['limit' => 255])
            ->addColumn('link', 'string', ['limit' => 255,'null' => true])
            ->addColumn('description', 'string', ['null' => true])
            ->addColumn('publisher', 'string', ['limit' => 255,'null' => true])
            ->addColumn('publisher_url', 'string', ['limit' => 255,'null' => true])
            ->addColumn('language', 'string', ['limit' => 8,'null' => true])
            ->addColumn('file', 'string', ['limit' => 255,'null' => true])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
