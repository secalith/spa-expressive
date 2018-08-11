<?php


use Phinx\Migration\AbstractMigration;

class CreateCredentialsResetTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('credentials_reset');
    }

    public function change()
    {
        $table = $this->table('credentials_reset', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('email',  'string', ['limit' => 255])
            ->addColumn('token',  'string')
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
