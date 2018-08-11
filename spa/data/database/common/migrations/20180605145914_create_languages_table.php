<?php


use Phinx\Migration\AbstractMigration;

class CreateLanguagesTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('languages');
    }

    public function change()
    {
        $table = $this->table('languages', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('code',  'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('label',  'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
