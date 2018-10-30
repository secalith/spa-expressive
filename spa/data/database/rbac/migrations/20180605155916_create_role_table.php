<?php


use Phinx\Migration\AbstractMigration;

class CreateRoleTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('role');
    }

    public function change()
    {
        $table = $this->table('role', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('name',  'string', ['limit' => 64])
            ->addColumn('description',  'string', ['limit' => 255])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
