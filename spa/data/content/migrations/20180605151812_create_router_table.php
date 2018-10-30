<?php


use Phinx\Migration\AbstractMigration;

class CreateRouterTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('router');
    }

    public function change()
    {
        $table = $this->table('router', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('parent_uid',  'string', ['limit' => 64,'default' => 0])
            ->addColumn('application_uid',  'string', ['limit' => 64,'default' => 0])
            ->addColumn('route_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('route_url', 'string')
            ->addColumn('scenario',  'string', ['limit' => 32])
            ->addColumn('controller', 'string', ['limit' => 64])
            ->addColumn('method', 'string', ['limit' => 8,'default' => 'get'])
            ->addColumn('attributes', 'string', ['default' => '{}'])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
