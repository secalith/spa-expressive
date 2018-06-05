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
                'route_uid'    => 'route-001',
                'route_url'    => '/homepage',
                'scenario'    => 'display',
                'controller'    => '\Page\Action\PageAction',
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
