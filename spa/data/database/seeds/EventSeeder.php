<?php


use Phinx\Seed\AbstractSeed;

class EventSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'event-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_group' => 'event-group-001',
                'name' => 'Katowice 29/07 #StopActa2',
                'country' => 'pl_pl',
                'status' => 1,
                'created' => '2018-07-29 18:00',
            ],
            [
                'uid' => 'event-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_group' => 'event-group-001',
                'name' => 'Kraków 29/07 #StopActa2',
                'country' => 'pl_pl',
                'status' => 1,
                'created' => '2018-07-29 18:00',
            ],
            [
                'uid' => 'event-003',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_group' => 'event-group-001',
                'name' => 'Warszawa  29/07 #StopActa2',
                'country' => 'pl_pl',
                'status' => 1,
                'created' => '2018-07-29 19:00',
            ],
        ];

        $table = $this->table('event');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
