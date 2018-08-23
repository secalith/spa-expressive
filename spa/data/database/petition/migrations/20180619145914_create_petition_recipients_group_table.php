<?php


use Phinx\Migration\AbstractMigration;

class CreatePetitionRecipientsGroupTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_recipients_group');
    }

    public function change()
    {
        $table = $this->table('petition_recipients_group', ['id' => false]);
        $table->addColumn('petition_uid', 'string', ['limit' => 64])
            ->addColumn('petition_translation_uid',  'string', ['limit' => 64])
            ->addColumn('recipient_group_uid',  'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
