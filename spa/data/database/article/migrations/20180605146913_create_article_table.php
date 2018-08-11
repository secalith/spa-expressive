<?php


use Phinx\Migration\AbstractMigration;

class CreateArticleTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('article');
    }

    public function change()
    {
        $table = $this->table('article', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('article_type',  'string', ['limit' => 64])
            ->addColumn('article_group',  'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('country', 'string', ['limit' => 32])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
