<?php


use Phinx\Migration\AbstractMigration;

class CreateCredentialsTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('credentials');
    }

    public function change()
    {
        $table = $this->table('credentials', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('password',  'string')
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
