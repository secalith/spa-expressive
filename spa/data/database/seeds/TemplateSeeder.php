<?php


use Phinx\Seed\AbstractSeed;

class TemplateSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'template-001',
                'route_uid'    => 'route-001',
                'type'    => 'filesystem',
                'location'    => 'page-view',
                'name'    => 'page-standard-spa',
                'label'    => 'Stadard SPA Template',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'template-002',
                'route_uid'    => 'route-002',
                'type'    => 'filesystem',
                'location'    => 'page-view',
                'name'    => 'page-standard-spa',
                'label'    => 'art13.eu',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'template-003',
                'route_uid'    => 'route-003',
                'type'    => 'filesystem',
                'location'    => 'page-view',
                'name'    => 'page-petitions-spa',
                'label'    => 'Petitions Homepage',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'template-004',
                'route_uid'    => 'route-004',
                'type'    => 'filesystem',
                'location'    => 'page-view',
                'name'    => 'page-petitions-spa',
                'label'    => 'Petitions Homepage',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'template-005',
                'route_uid'    => 'route-005',
                'type'    => 'filesystem',
                'location'    => 'page-view',
                'name'    => 'page-petitions-spa',
                'label'    => 'Petitions Homepage',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('template');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
