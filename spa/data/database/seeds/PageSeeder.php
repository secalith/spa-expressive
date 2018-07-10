<?php


use Phinx\Seed\AbstractSeed;

class PageSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'page-001',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-001',
                'route_uid'    => 'route-001',
                'template_uid'    => 'template-001',
                'name'    => 'home',
                'route_url'    => '/',
                'page_cache'    => 0,
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'page-002',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-003',
                'route_uid'    => 'route-002',
                'template_uid'    => 'template-002',
                'name'    => 'home',
                'route_url'    => '/',
                'page_cache'    => 0,
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('page');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
