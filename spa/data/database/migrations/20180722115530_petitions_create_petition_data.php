<?php


use Phinx\Migration\AbstractMigration;

class PetitionsCreatePetitionData extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_data');
    }

    public function change()
    {
        $table = $this->table('petition_data', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('petition_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('text_uid', 'string', ['limit' => 64])
            ->addColumn('language', 'string')
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
