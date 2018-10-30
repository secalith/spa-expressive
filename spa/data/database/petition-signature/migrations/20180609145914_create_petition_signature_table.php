<?php


use Phinx\Migration\AbstractMigration;

class CreatePetitionSignatureTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_signature');
    }

    public function change()
    {
        $table = $this->table('petition_signature', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('petition_uid',  'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('ip', 'string', ['limit' => 255])
            ->addColumn('terms', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('privacy_policy', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('newsletter', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
