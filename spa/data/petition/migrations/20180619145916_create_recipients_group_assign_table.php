<?php


use Phinx\Migration\AbstractMigration;

class CreateRecipientsGroupAssignTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('recipients_group_assign');
    }

    public function change()
    {
        $table = $this->table('recipients_group_assign', ['id' => false]);
        $table->addColumn('recipient_uid',  'string', ['limit' => 64])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('group_uid',  'string', ['limit' => 64])
            ->addColumn('created', 'datetime')
        ->save();
    }
}
