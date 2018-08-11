<?php


use Phinx\Seed\AbstractSeed;

class EventGroupSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'event-group-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'Group 2018-07-29',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('event_group');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
