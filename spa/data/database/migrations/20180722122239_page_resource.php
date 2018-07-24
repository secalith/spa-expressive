<?php


use Phinx\Migration\AbstractMigration;

class PageResource extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('page_resource');
    }

    public function change()
    {
        $table = $this->table('page_resource', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('page_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('site_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('resource_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('resource_name', 'string', ['limit' => 16])
            ->addColumn('resource_type', 'string', ['limit' => 16])
            ->addColumn('resource_cache', 'integer', ['limit' => 1,'default' => 0])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
