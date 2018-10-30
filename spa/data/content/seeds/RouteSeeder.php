<?php


use Phinx\Seed\AbstractSeed;

class RouteSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'route-001',
                'route_name'    => 'home',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'route-002',
                'route_name'    => 'home',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'route-003',
                'route_name'    => 'peticio.home',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'route-004',
                'route_name'    => 'peticio.home',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'route-005',
                'route_name'    => 'privacy-policy',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'route-006',
                'route_name'    => 'privacy-policy',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'route-007',
                'route_name'    => 'shrt.home',
                'comm'    => 'homepage for shrt.local.vm',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'route-008',
                'route_name'    => 'peticio.home.post',
                'comm'    => 'homepage for shrt.local.vm',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'route-009',
                'route_name'    => 'petycja.home',
                'comm' => 'homepage for petycja.art13.eu',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'route-010',
                'route_name'    => 'petycja.home.post',
                'comm'    => 'homepage for petycja.art13.eu',
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
