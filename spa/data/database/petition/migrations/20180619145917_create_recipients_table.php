<?php


use Phinx\Migration\AbstractMigration;

class CreateRecipientsTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('recipients');
    }

    public function change()
    {
        $table = $this->table('recipients', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('name',  'string', ['limit' => 255])
            ->addColumn('email',  'string', ['limit' => 255])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
