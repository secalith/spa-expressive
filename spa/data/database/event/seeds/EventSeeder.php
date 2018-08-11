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
                'name' => 'Protest w obronie Internetu - Kraków 26.08 #StopACTA2',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_group' => 'event-group-001',
                'name' => 'Marsz w obronie Internetu - Warszawa 26.08 #StopACTA2',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-003',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_group' => 'event-group-001',
                'name' => 'Protest w obronie Internetu - Katowice 26.08 #StopACTA2',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-004',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_group' => 'event-group-001',
                'name' => 'Protest w obronie Internetu - Wrocław 26.08 #StopACTA2',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-005',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_group' => 'event-group-001',
                'name' => 'Protest w obronie Internetu - Łódź 26.08 #StopACTA2',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('event');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
