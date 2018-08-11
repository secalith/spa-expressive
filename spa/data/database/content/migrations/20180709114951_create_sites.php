<?php


use Phinx\Migration\AbstractMigration;

class CreateSites extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('site');
    }

    public function change()
    {
        $table = $this->table('site', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('site_name',  'string', ['limit' => 255])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
