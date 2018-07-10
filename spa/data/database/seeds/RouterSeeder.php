<?php

use Phinx\Seed\AbstractSeed;

class RouterSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'router-001',
                'parent_uid'    => '0',
                'application_uid'    => 'app-001',
                'route_uid'    => 'route-001',
                'site_uid'    => 'site-001',
                'route_url'    => '/',
                'scenario'    => 'display',
                'controller'    => '\Page\Handler\PageHandler',
                'attributes'    => '{}',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'router-002',
                'parent_uid'    => '0',
                'application_uid'    => 'app-001',
                'route_uid'    => 'route-002',
                'site_uid'    => 'site-003',
                'route_url'    => '/',
                'scenario'    => 'display',
                'controller'    => '\Page\Handler\PageHandler',
                'attributes'    => '{}',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('router');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
