<?php


use Phinx\Migration\AbstractMigration;

class CreateBlockTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('block');
    }

    public function change()
    {
        $table = $this->table('block', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('parent_uid', 'string', ['limit' => 64,'default'=>0])
            ->addColumn('area_uid', 'string', ['limit' => 64])
            ->addColumn('template_uid', 'string', ['limit' => 64])
            ->addColumn('type', 'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('content', 'string')
            ->addColumn('attributes', 'string',['default' => '{}'])
            ->addColumn('parameters', 'string',['default' => '{}'])
            ->addColumn('options', 'string',['default' => '{}'])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('order', 'integer', ['limit' => 8])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
