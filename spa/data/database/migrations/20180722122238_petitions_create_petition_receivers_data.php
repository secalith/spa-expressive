<?php


use Phinx\Migration\AbstractMigration;

class PetitionsCreatePetitionReceiversData extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_receivers_data');
    }

    public function change()
    {
        $table = $this->table('petition_receivers_data', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('receiver_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
