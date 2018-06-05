<?php


use Phinx\Migration\AbstractMigration;

class CreateSettingsTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('settings');
    }

    public function change()
    {
        $table = $this->table('settings', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('module',  'string', ['limit' => 64])
            ->addColumn('name',  'string', ['limit' => 255])
            ->addColumn('value', 'string', ['limit' => 255])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
