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
                'page_layout'    => 'layout::art13-1',
                'language'    => 'en_en',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'page-002',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-002',
                'route_uid'    => 'route-002',
                'template_uid'    => 'template-001',
                'name'    => 'home',
                'route_url'    => '/',
                'page_cache'    => 0,
                'page_layout'    => 'layout::art13-1',
                'language'    => 'pl_pl',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'page-003',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-003',
                'route_uid'    => 'route-003',
                'template_uid'    => 'template-001',
                'name'    => 'home',
                'route_url'    => '/',
                'page_cache'    => 0,
                'page_layout'    => 'layout::art13-1',
                'language'    => 'pl_pl',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'page-004',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-004',
                'route_uid'    => 'route-004',
                'template_uid'    => 'template-001',
                'name'    => 'home',
                'route_url'    => '/',
                'page_cache'    => 0,
                'page_layout'    => 'layout::art13-1',
                'language'    => 'pl_pl',
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
