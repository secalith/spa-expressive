<?php


use Phinx\Seed\AbstractSeed;

class EventDetailsSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'event-details-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'event_uid' => 'event-001',
                'name' => 'Marsz w obronie internetu - #StopACTA2 SaveYourInternet',
                'city' => 'Katowice',
                'city_global' => 'Katowice',
                'org_global' => 'StopACTA2.Poland',
                'org_link' => 'https://www.facebook.com/StopACTA2.Katowice/',
                'org_link_global' => 'https://www.facebook.com/Stopacta2.Poland/',
                'addr_line' => 'Katowice Rynek Plac nad Rawą',
                'date_start' => '2018-07-29 18:00:00',
                'date_finish' => '2018-07-29 18:00:00',
                'timezone' => 'utc_1',
                'language' => 'pl_pl',
                'event_link_external' => 'https://www.facebook.com/events/1736159829808663/',
                'event_map_external' => 'https://www.google.com/maps/search/Katowice+Rynek+Plac+nad+Rawą/@50.259622,19.0295524,16z/',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-details-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'Marsz w obronie internetu - #StopACTA2 SaveYourInternet',
                'event_uid' => 'event-002',
                'city' => 'Kraków',
                'city_global' => 'Krakow',
                'org_global' => 'StopACTA2.Poland',
                'org_link' => 'https://www.facebook.com/Stopacta2.Poland/',
                'org_link_global' => 'https://www.facebook.com/Stopacta2.Poland/',
                'addr_line' => 'Rynek Glowny Krakow',
                'date_start' => '2018-07-29 19:00:00',
                'date_finish' => '2018-07-29 19:00:00',
                'timezone' => 'utc_1',
                'language' => 'pl_pl',
                'event_link_external' => 'https://www.facebook.com/events/1849272128711784/',
                'event_map_external' => 'utc_1',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'event-details-003',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'Marsz w obronie internetu - #StopACTA2 SaveYourInternet',
                'event_uid' => 'event-003',
                'city' => 'Warszawa',
                'city_global' => 'Warsaw',
                'org' => 'Warsaw',
                'org_global' => 'StopACTA2.Poland',
                'org_link' => 'https://www.facebook.com/Stopacta2.Poland/',
                'org_link_global' => 'https://www.facebook.com/Stopacta2.Poland/',
                'addr_line' => 'Plac Defilad w Warszawie',
                'date_start' => '2018-07-29 19:00:00',
                'date_finish' => '2018-07-29 19:00:00',
                'timezone' => 'utc_1',
                'language' => 'pl_pl',
                'event_link_external' => 'https://www.facebook.com/events/2035752230086477/',
                'event_map_external' => 'https://www.google.com/maps/place/plac+Defilad,+Warszawa,+Poland/@52.2322737,21.0062158,17z/',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('event_details');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
