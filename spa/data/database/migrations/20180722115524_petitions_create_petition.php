<?php


use Phinx\Migration\AbstractMigration;

class PetitionsCreatePetition extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition');
    }

    public function change()
    {
        $table = $this->table('petition', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('site_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('name',  'string', ['limit' => 64])
            ->addColumn('data_uid',  'string', ['limit' => 64])
            ->addColumn('default_language',  'string', ['limit' => 8])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
