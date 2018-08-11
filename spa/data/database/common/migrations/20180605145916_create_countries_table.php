<?php


use Phinx\Migration\AbstractMigration;

class CreateLanguagesTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('countries');
    }

    public function change()
    {
        $table = $this->table('countries', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('label',  'string', ['limit' => 64])
            ->addColumn('iso2',  'string', ['limit' => 64])
            ->addColumn('iso3',  'string', ['limit' => 64])
            ->addColumn('m49',  'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
