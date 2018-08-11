<?php


use Phinx\Migration\AbstractMigration;

class CreatePermissionTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('permission');
    }

    public function change()
    {
        $table = $this->table('permission', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('name',  'string', ['limit' => 255])
            ->addColumn('description',  'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
