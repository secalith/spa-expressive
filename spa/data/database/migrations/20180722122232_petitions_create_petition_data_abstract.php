<?php


use Phinx\Migration\AbstractMigration;

class PetitionsCreatePetitionDataAbstract extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_data_abstract');
    }

    public function change()
    {
        $table = $this->table('petition_data_abstract', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('petition_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('abstract',  'string')
            ->addColumn('language', 'string')
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('revision', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('version', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
