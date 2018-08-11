<?php


use Phinx\Seed\AbstractSeed;

class EventDetailsSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'event-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_uid' => 'event-001',
                'name' => 'Protest w obronie Internetu - Kraków 26.08 #StopACTA2',
                'name_global' => 'Protest in defence of the Internet - Krakow 26.08 #StopACTA2',
                'city' => 'Kraków',
                'city_global' => 'Krakow',
                'org_global' => '',
                'org_link' => '',
                'org_link_global' => '',
                'addr_line' => '',
                'date_start' => '2018-08-26 18:00:00',
                'date_finish' => '',
                'timezone' => 'utc_2',
                'image' => '',
                'event_link_external' => 'https://www.facebook.com/events/1849272128711784/',
                'event_map_external' => 'https://www.google.com/maps/@50.0619005,19.9345619,17z',
                'comm' => '',
                'language' => 'pl_pl',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_uid' => 'event-002',
                'name' => 'Marsz w obronie Internetu - Warszawa 26.08 #StopACTA2',
                'name_global' => 'Rally in defence of the Internet - Warsaw 26.08 #StopACTA2',
                'city' => 'Warszawa',
                'city_global' => 'Warsaw',
                'org_global' => '',
                'org_link' => '',
                'org_link_global' => '',
                'addr_line' => '',
                'date_start' => '2018-08-26 19:00:00',
                'date_finish' => '2018-08-26 22:00:00',
                'timezone' => 'utc_2',
                'image' => '',
                'event_link_external' => 'https://www.facebook.com/events/2035752230086477/',
                'event_map_external' => 'https://www.google.com/maps/place/@52.232277,21.0062105,17z',
                'comm' => '',
                'language' => 'pl_pl',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-003',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_uid' => 'event-003',
                'name' => 'Protest w obronie Internetu - Katowice 26.08 #StopACTA2',
                'name_global' => 'Protest in defence of the Internet - Katowice 26.08 #StopACTA2',
                'city' => 'Katowice',
                'city_global' => 'Katowice',
                'org_global' => '',
                'org_link' => '',
                'org_link_global' => '',
                'addr_line' => '',
                'date_start' => '2018-08-26 18:00:00',
                'date_finish' => '',
                'timezone' => 'utc_2',
                'image' => '',
                'event_link_external' => 'https://www.facebook.com/events/1736159829808663/',
                'event_map_external' => 'https://www.google.com/maps/@50.2633165,19.0406182,17z',
                'comm' => '',
                'language' => 'pl_pl',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-004',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_uid' => 'event-004',
                'name' => 'Protest w obronie Internetu - Wrocław 26.08 #StopACTA2',
                'name_global' => 'Protest in defence of the Internet - Wrocław 26.08 #StopACTA2',
                'city' => 'Wrocław',
                'city_global' => 'Wroclaw',
                'org_global' => '',
                'org_link' => '',
                'org_link_global' => '',
                'addr_line' => '',
                'date_start' => '2018-08-26 18:00:00',
                'date_finish' => '',
                'timezone' => 'utc_2',
                'image' => 'pl_pl',
                'event_link_external' => 'https://www.facebook.com/events/208686879796389/',
                'event_map_external' => '',
                'comm' => '',
                'language' => 'pl_pl',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-005',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_uid' => 'event-005',
                'name' => 'Protest w obronie Internetu - Łódź 26.08 #StopACTA2',
                'name_global' => 'Protest in defence of the Internet - Lodz 26.08 #StopACTA2',
                'city' => 'Łódź',
                'city_global' => 'Lodz',
                'org_global' => '',
                'org_link' => '',
                'org_link_global' => '',
                'addr_line' => '',
                'date_start' => '2018-08-26 18:00:00',
                'date_finish' => '2018-08-26 20:00:00',
                'timezone' => 'utc_2',
                'image' => 'pl_pl',
                'event_link_external' => 'https://www.facebook.com/events/2171593299790462/',
                'event_map_external' => '',
                'comm' => '',
                'language' => 'pl_pl',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('event_details');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}