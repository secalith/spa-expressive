<?php


use Phinx\Migration\AbstractMigration;

class CreateRouteTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('route');
    }

    public function change()
    {
        $table = $this->table('route', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('route_name',  'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('comm', 'string',['null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
