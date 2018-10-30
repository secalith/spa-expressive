<?php

use Phinx\Migration\AbstractMigration;

class CreateMemeImageTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('meme_image');
    }

    public function change()
    {
        $table = $this->table('meme_image', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('item_uid', 'string', ['limit' => 64])
            ->addColumn('image', 'string', ['null' => true])
            ->addColumn('comm', 'string', ['null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
