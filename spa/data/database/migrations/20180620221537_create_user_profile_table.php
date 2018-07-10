<?php


use Phinx\Migration\AbstractMigration;

class CreateUserProfileTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('user_profile');
    }

    public function change()
    {
        $table = $this->table('user_profile', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('name_first',  'string', ['limit' => 255])
            ->addColumn('name_last',  'string', ['limit' => 255])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
