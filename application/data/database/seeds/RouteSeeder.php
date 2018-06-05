<?php


use Phinx\Seed\AbstractSeed;

class RouteSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'route-001',
                'route_name'    => 'Custom Route #1',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('route');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
