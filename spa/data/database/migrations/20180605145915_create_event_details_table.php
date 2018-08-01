<?php


use Phinx\Migration\AbstractMigration;

class CreateEventDetailsTable extends AbstractMigration
{
    public function up()
    {
        $this->dropTable('event_details');
    }

    public function change()
    {
        $table = $this->table('event_details', ['id' => false, 'primary_key' => ['uid']]);
        $table->addColumn('uid', 'string', ['limit' => 64])
            ->addColumn('application_uid',  'string', ['limit' => 64])
            ->addColumn('site_uid',  'string', ['limit' => 64])
            ->addColumn('event_uid',  'string', ['limit' => 64])
            ->addColumn('city', 'string', ['limit' => 255])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('city_global', 'string', ['limit' => 255])
            ->addColumn('org_global', 'string', ['limit' => 255])
            ->addColumn('org_link', 'string', ['limit' => 255])
            ->addColumn('org_link_global', 'string', ['limit' => 255])
            ->addColumn('addr_line', 'string', ['limit' => 255])
            ->addColumn('date_start', 'datetime')
            ->addColumn('date_finish', 'datetime', ['null' => true])
            ->addColumn('timezone', 'datetime', ['null' => true])
            ->addColumn('image', 'string', ['limit' => 255,'null' => true])
            ->addColumn('language', 'string', ['limit' => 8,'null' => true])
            ->addColumn('event_link_external', 'string', ['limit' => 255,'null' => true])
            ->addColumn('event_map_external', 'string', ['limit' => 255,'null' => true])
            ->addColumn('status', 'integer', ['limit' => 8,'default' => 0])
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
        ->save();
    }
}
