<?php


use Phinx\Migration\AbstractMigration;

class CreatePageTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('page');
    }

    public function change()
    {
        $table = $this->table('page', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('route_uid',  'string', ['limit' => 64])
            ->addColumn('template_uid', 'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('route_url', 'string')
            ->addColumn('page_cache', 'integer', ['limit' => 1,'default' => 0])
            ->addColumn('page_layout', 'string', ['limit' => 64,'default' => 'default'])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
