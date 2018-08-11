<?php


use Phinx\Migration\AbstractMigration;

class CreatePetitionTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition');
    }

    public function change()
    {
        $table = $this->table('petition', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('group',  'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('name_global', 'string', ['limit' => 255])
            ->addColumn('country', 'string', ['limit' => 8])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
