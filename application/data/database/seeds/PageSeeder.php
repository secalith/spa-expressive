<?php


use Phinx\Seed\AbstractSeed;

class PageSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'page-001',
                'route_uid'    => 'route-001',
                'template_uid'    => 'template-001',
                'name'    => 'spa.home',
                'route_url'    => '/homepage',
                'page_cache'    => 0,
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
