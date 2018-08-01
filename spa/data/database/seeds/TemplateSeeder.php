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
                'name'    => 'page-standard-art13',
                'label'    => 'manager.local.vm',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'template-002',
                'route_uid'    => 'route-002',
                'type'    => 'filesystem',
                'location'    => 'page-view',
                'name'    => 'page-standard-art13',
                'label'    => 'art13.eu',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'template-003',
                'route_uid'    => 'route-003',
                'type'    => 'filesystem',
                'location'    => 'page-view',
                'name'    => 'page-standard-art13',
                'label'    => 'petycja.art13.eu',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'template-004',
                'route_uid'    => 'route-004',
                'type'    => 'filesystem',
                'location'    => 'page-view',
                'name'    => 'page-standard-art13',
                'label'    => 'peticio.art13.eu',
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
