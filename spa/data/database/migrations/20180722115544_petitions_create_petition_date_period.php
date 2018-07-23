<?php


use Phinx\Migration\AbstractMigration;

class PetitionsCreatePetitionDatePeriod extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_date');
    }

    public function change()
    {
        $table = $this->table('petition_date', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('petition_uid', 'string', ['limit' => 64])
            ->addColumn('date_start',  'datetime', ['null' => true])
            ->addColumn('date_end',  'datetime', ['null' => true])
            ->addColumn('change_to',  'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('priority', 'integer', ['limit' => 8])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
