<?php

use Phinx\Migration\AbstractMigration;

class CreateMemeTextTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('meme_text');
    }

    public function change()
    {
        $table = $this->table('meme_text', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('item_uid', 'string', ['limit' => 64])
            ->addColumn('text', 'string', ['null' => 1000])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
