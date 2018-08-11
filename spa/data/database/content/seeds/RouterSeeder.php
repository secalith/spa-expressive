<?php

use Phinx\Seed\AbstractSeed;

class RouterSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'router-001',
                'parent_uid' => '0',
                'application_uid' => 'app-001',
                'route_uid' => 'route-001',
                'site_uid' => 'site-001',
                'route_url' => '/',
                'scenario' => 'display',
                'controller' => '\Page\Handler\PageHandler',
                'method' => 'get',
                'attributes' => '{}',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'router-002',
                'parent_uid' => '0',
                'application_uid' => 'app-001',
                'route_uid' => 'route-002',
                'site_uid' => 'site-002',
                'route_url' => '/',
                'scenario' => 'display',
                'controller' => '\Page\Handler\PageHandler',
                'method' => 'get',
                'attributes' => '{}',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'router-003',
                'parent_uid' => '0',
                'application_uid' => 'app-001',
                'route_uid' => 'route-003',
                'site_uid' => 'site-003',
                'route_url' => '/',
                'scenario' => 'display',
                'controller' => '\Page\Handler\PageHandler',
                'method' => 'get',
                'attributes' => '{}',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'router-004',
                'parent_uid' => '0',
                'application_uid' => 'app-001',
                'route_uid' => 'route-004',
                'site_uid' => 'site-004',
                'route_url' => '/',
                'scenario' => 'display',
                'controller' => '\Page\Handler\PageHandler',
                'method' => 'get',
                'attributes' => '{}',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'router-005',
                'parent_uid' => '0',
                'application_uid' => 'app-001',
                'route_uid' => 'route-005',
                'site_uid' => 'site-001',
                'route_url' => '/privacy-policy',
                'scenario' => 'display',
                'controller' => '\Page\Handler\PageHandler',
                'method' => 'get',
                'attributes' => '{}',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'router-006',
                'parent_uid' => '0',
                'application_uid' => 'app-001',
                'route_uid' => 'route-006',
                'site_uid' => 'site-002',
                'route_url' => '/privacy-policy',
                'scenario' => 'display',
                'controller' => '\Page\Handler\PageHandler',
                'method' => 'get',
                'attributes' => '{}',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'router-007',
                'parent_uid' => '0',
                'application_uid' => 'app-003',
                'route_uid' => 'route-007',
                'site_uid' => 'site-005',
                'route_url' => '/',
                'scenario' => 'display',
                'controller' => 'Common\Handler\Create',
                'method' => 'get',
                'attributes' => '{}',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'router-008',
                'parent_uid' => '0',
                'application_uid' => 'app-001',
                'route_uid' => 'route-008',
                'site_uid' => 'site-004',
                'route_url' => '/',
                'scenario' => 'process',
                'controller' => '\Page\Handler\PageHandler',
                'method' => 'post',
                'attributes' => '{}',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('router');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
