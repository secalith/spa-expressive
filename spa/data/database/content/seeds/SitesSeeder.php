<?php


use Phinx\Seed\AbstractSeed;

class SitesSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'site-001',
                'site_name'    => 'manager.local.vm',
                'application_uid'    => 'app-001',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'site-002',
                'site_name'    => 'art13.eu',
                'application_uid'    => 'app-001',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'site-003',
                'site_name'    => 'peticio.art13.eu',
                'application_uid'    => 'app-001',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'site-004',
                'site_name'    => 'peticio.local.vm',
                'application_uid'    => 'app-001',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'site-005',
                'site_name'    => 'shrt.local.vm',
                'application_uid'    => 'app-003',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('site');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
