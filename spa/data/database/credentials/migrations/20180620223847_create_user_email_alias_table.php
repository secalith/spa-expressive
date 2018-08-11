<?php


use Phinx\Migration\AbstractMigration;

class CreateUserEmailAliasTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('user_email_alias');
    }

    public function change()
    {
        $table = $this->table('user_email_alias', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('email',  'string', ['limit' => 255])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->addIndex(['email'], ['unique' => true])
            ->save();
    }
}
