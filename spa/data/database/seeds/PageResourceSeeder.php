<?php


use Phinx\Seed\AbstractSeed;

class PageResourceSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'page-resource-001',
                'page_uid'    => 'page-003',
                'site_uid'    => 'site-003',
                'resource_uid'    => 'petition-001',
                'resource_name'    => 'petition',
                'resource_type'    => 'petition',
                'resource_cache'    => 0,
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'page-resource-002',
                'page_uid'    => 'page-004',
                'site_uid'    => 'site-004',
                'resource_uid'    => 'petition-001',
                'resource_name'    => 'petition',
                'resource_type'    => 'petition',
                'resource_cache'    => 0,
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'page-resource-003',
                'page_uid'    => 'page-005',
                'site_uid'    => 'site-003',
                'resource_uid'    => 'petition-001',
                'resource_name'    => 'petition',
                'resource_type'    => 'petition',
                'resource_cache'    => 0,
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('page_resource');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
