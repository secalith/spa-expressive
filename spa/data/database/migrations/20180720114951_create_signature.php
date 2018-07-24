<?php


use Phinx\Migration\AbstractMigration;

class CreateSignature extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('signature');
    }

    public function change()
    {
        $table = $this->table('signature', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('petition_uid',  'string', ['limit' => 64])
            ->addColumn('name_first',  'string', ['limit' => 64])
            ->addColumn('name_last',  'string', ['limit' => 64])
            ->addColumn('contact_email',  'string', ['limit' => 64])
            ->addColumn('ip', 'string', ['limit' => 32,'default' => 0])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
