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
        ];

        $table = $this->table('template');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
