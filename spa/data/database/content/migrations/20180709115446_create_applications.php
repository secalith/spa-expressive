<?php


use Phinx\Migration\AbstractMigration;

class CreateApplications extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('application', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('type',  'string', ['limit' => 16])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
