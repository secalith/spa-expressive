<?php


use Phinx\Migration\AbstractMigration;

class CreateRoleHierarchyTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('role_hierarchy');
    }

    public function change()
    {
        $table = $this->table('role_hierarchy', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('parent_role_uid',  'string', ['limit' => 64])
            ->addColumn('child_role_uid',  'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
