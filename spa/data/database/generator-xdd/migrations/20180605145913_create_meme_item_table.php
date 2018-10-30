<?php

use Phinx\Migration\AbstractMigration;

class CreateMemeItemTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('meme_item');
    }

    public function change()
    {
        $table = $this->table('meme_item', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
