<?php


use Phinx\Seed\AbstractSeed;

class AreaSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'area-000',
                'template_uid'    => null,
                'machine_name'    => 'global_header',
                'scope'    => 'global',
                'attributes'    => '{}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'area-001',
                'template_uid'    => 'template-001',
                'machine_name'    => 'content_main',
                'scope'    => 'page',
                'attributes'    => '{}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'area-003',
                'template_uid' => null,
                'machine_name' => 'global_footer',
                'scope' => 'global',
                'attributes' => '{}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('area');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
