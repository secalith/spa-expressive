<?php


use Phinx\Migration\AbstractMigration;

class CreateInstanceTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('instances');
    }

    public function change()
    {
        $table = $this->table('instances', ['id' => false, 'primary_key' => ['uid']]);

        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('client_uid',  'string', ['limit' => 64])
            ->addColumn('hostname',  'string', ['limit' => 255])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
