<?php


use Phinx\Migration\AbstractMigration;

class CreateUserOptInTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('user_optin');
    }

    public function change()
    {
        $table = $this->table('user_optin', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('terms',  'integer', ['limit' => 1])
            ->addColumn('newsletter',  'integer', ['limit' => 1])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
