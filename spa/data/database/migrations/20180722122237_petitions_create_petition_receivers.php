<?php


use Phinx\Migration\AbstractMigration;

class PetitionsCreatePetitionReceivers extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_receivers');
    }

    public function change()
    {
        $table = $this->table('petition_receivers', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('receiver_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
