<?php


use Phinx\Seed\AbstractSeed;

class SitesSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'site-001',
                'site_name'    => 'spa',
                'application_uid'    => 'app-001',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'site-002',
                'site_name'    => 'art13',
                'application_uid'    => 'app-001',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'site-003',
                'site_name'    => 'petitions',
                'application_uid'    => 'app-001',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'site-004',
                'site_name'    => 'blog_art13',
                'application_uid'    => 'app-002',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'site-005',
                'site_name'    => 'blog_kowalski',
                'application_uid'    => 'app-002',
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
