<?php


use Phinx\Migration\AbstractMigration;

class CreateUserRoleTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('user_role');
    }

    public function change()
    {
        $table = $this->table('user_role', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('user_uid',  'string', ['limit' => 64])
            ->addColumn('role_uid',  'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
