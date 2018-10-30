<?php


use Phinx\Migration\AbstractMigration;

class UpdatePetitionSignatureTableTerms extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_signature');
    }

    public function change()
    {
        $table = $this->table('petition_signature', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('terms', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('privacy_policy', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('newsletter', 'integer', ['limit' => 8,'default' => 0])
        ->save();
    }
}
