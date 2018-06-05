<?php


use Phinx\Migration\AbstractMigration;

class CreateAreaTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('area');
    }

    public function change()
    {
        $table = $this->table('area', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('template_uid', 'string', ['limit' => 64])
            ->addColumn('machine_name',  'string', ['limit' => 64])
            ->addColumn('scope', 'string', ['limit' => 8])
            ->addColumn('attributes', 'string',['default' => '{}'])
            ->addColumn('parameters', 'string',['default' => '{}'])
            ->addColumn('options', 'string',['default' => '{}'])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('order', 'integer', ['limit' => 8])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
