<?php


use Phinx\Migration\AbstractMigration;

class CreatePetitionTranslationTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('petition_translation');
    }

    public function change()
    {
        $table = $this->table('petition_translation', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('petition_uid',  'string', ['limit' => 64])
            ->addColumn('title', 'string', ['limit' => 255])
            ->addColumn('description', 'string')
            ->addColumn('text', 'string')
            ->addColumn('image', 'string', ['limit' => 255,'null' => true])
            ->addColumn('language', 'string', ['limit' => 8,'null' => true])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
