<?php


use Phinx\Migration\AbstractMigration;

class PageTypeAreas extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('page_type_areas');
    }

    public function change()
    {
        $table = $this->table('page_type_areas', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('page_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('site_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('area_name', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('resource_uid', 'string', ['limit' => 64], ['null' => true])
            ->addColumn('resource_type', 'string', ['limit' => 16], ['null' => true])
            ->addColumn('order', 'integer', ['limit' => 1,'default' => 0])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->save()
        ;
    }
}
