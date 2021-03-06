<?php


use Phinx\Seed\AbstractSeed;

class TemplateSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'template-001',
                'route_uid' => 'route-001',
                'type' => 'filesystem',
                'location' => 'page-view',
                'name' => 'page-standard-art13',
                'label' => 'manager.local.vm',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'template-002',
                'route_uid' => 'route-002',
                'type' => 'filesystem',
                'location' => 'page-view',
                'name' => 'page-standard-art13',
                'label' => 'art13.eu',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'template-003',
                'route_uid' => 'route-003',
                'type' => 'filesystem',
                'location' => 'petition-view',
                'name' => 'petition-standard',
                'label' => 'peticio.art13.eu',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'template-004',
                'route_uid' => 'route-004',
                'type' => 'filesystem',
                'location' => 'petition-view',
                'name' => 'petition-standard',
                'label' => 'peticio.local.vm',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'template-005',
                'route_uid' => 'route-005',
                'type' => 'filesystem',
                'location' => 'page-view',
                'name' => 'page-standard-art13',
                'label' => 'manager.local.vm',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'template-006',
                'route_uid' => 'route-006',
                'type' => 'filesystem',
                'location' => 'page-view',
                'name' => 'page-standard-art13',
                'label' => 'art13.eu',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'template-007',
                'route_uid' => 'route-007',
                'type' => 'filesystem',
                'location' => 'shrt',
                'name' => 'page-standard-shrt',
                'label' => 'shrt.local.vm',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'template-008',
                'route_uid' => 'route-008',
                'type' => 'filesystem',
                'location' => 'petition-view',
                'name' => 'petition-standard',
                'label' => 'peticio.local.vm',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'template-009',
                'route_uid' => 'route-009',
                'type' => 'filesystem',
                'location' => 'petition-view',
                'name' => 'petition-standard',
                'label' => 'petycja.art13.eu',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'template-010',
                'route_uid' => 'route-010',
                'type' => 'filesystem',
                'location' => 'petition-view',
                'name' => 'petition-standard',
                'label' => 'petycja.art13.eu',
                'comm' => '',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('template');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
