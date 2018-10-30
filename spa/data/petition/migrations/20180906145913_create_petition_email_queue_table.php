<?php


use Phinx\Migration\AbstractMigration;

class CreatePetitionEmailQueueTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_email_queue');
    }

    public function change()
    {
        $table = $this->table('petition_email_queue', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('petition_uid',  'string', ['limit' => 64])
            ->addColumn('petition_translation_uid',  'string', ['limit' => 64])
            ->addColumn('petition_language',  'string', ['limit' => 64])
            ->addColumn('recipients_group_uid',  'string', ['limit' => 64])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
