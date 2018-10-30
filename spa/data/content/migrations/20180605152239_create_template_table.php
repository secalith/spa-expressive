<?php


use Phinx\Migration\AbstractMigration;

class CreateTemplateTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('template');
    }

    public function change()
    {
        $table = $this->table('template', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('route_uid',  'string', ['limit' => 64])
            ->addColumn('type',  'string', ['limit' => 64])
            ->addColumn('location',  'string', ['limit' => 64])
            ->addColumn('name', 'string')
            ->addColumn('label',  'string', ['limit' => 64])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
