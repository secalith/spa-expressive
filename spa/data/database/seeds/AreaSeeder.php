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
                'uid'    => 'area-003',
                'template_uid'    => null,
                'machine_name'    => 'global_footer',
                'scope'    => 'global',
                'attributes'    => '{}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'area-004',
                'template_uid'    => 'template-002',
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
                'uid'    => 'area-005',
                'template_uid'    => 'template-003',
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
                'uid'    => 'area-006',
                'template_uid'    => 'template-004',
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
                'uid'    => 'area-007',
                'template_uid'    => 'template-004',
                'machine_name'    => 'content_section',
                'scope'    => 'page',
                'attributes'    => '{}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'area-008',
                'template_uid'    => 'template-004',
                'machine_name'    => 'content_section',
                'scope'    => 'page',
                'attributes'    => '{}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 0,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'area-009',
                'template_uid'    => 'template-005',
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
                'uid'    => 'area-010',
                'template_uid'    => 'template-005',
                'machine_name'    => 'content_section',
                'scope'    => 'page',
                'attributes'    => '{}',
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
