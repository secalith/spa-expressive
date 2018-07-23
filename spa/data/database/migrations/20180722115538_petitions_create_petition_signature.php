<?php


use Phinx\Migration\AbstractMigration;

class PetitionsCreatePetitionSignature extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_signature');
    }

    public function change()
    {
        $table = $this->table('petition_signature', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('petition_uid', 'string', ['limit' => 64])
            ->addColumn('petition_text_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('name_first',  'string', ['limit' => 64])
            ->addColumn('name_last',  'string', ['limit' => 64])
            ->addColumn('email',  'string', ['limit' => 255])
            ->addColumn('language', 'string', ['limit' => 64])
            ->addColumn('ip', 'string', ['limit' => 64])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save();
    }
}
