<?php


use Phinx\Migration\AbstractMigration;

class CreateContentTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('content');
    }

    public function change()
    {
        $table = $this->table('content', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('parent_uid', 'string', ['limit' => 64,'default'=>0])
            ->addColumn('block_uid', 'string', ['limit' => 64])
            ->addColumn('template_uid', 'string')
            ->addColumn('type', 'string')
            ->addColumn('content', 'string')
            ->addColumn('attributes', 'string',['default' => '{}'])
            ->addColumn('parameters', 'string',['default' => '{}'])
            ->addColumn('options', 'string',['default' => '{}'])
            ->addColumn('language', 'string', ['limit' => 8,'default' => 'en_en'])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('order', 'string', ['limit' => 8])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
