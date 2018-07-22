<?php


use Phinx\Seed\AbstractSeed;

class ContentSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'content-001',
                'parent_uid'    => '0',
                'block_uid'    => 'block-009',
                'template_uid'    => 'template-001',
                'type'    => 'content',
                'content'    => 'Restaurant Management System',
                'attributes'    => '{"class":{"0":"mb-0 display-4 font-weight-normal"}}',
                'parameters'    => '{"html_tag":"h1"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'content-002',
                'parent_uid'    => '0',
                'block_uid'    => 'block-009',
                'template_uid'    => 'template-001',
                'type'    => 'content',
                'content'    => '',
                'attributes'    => '{"class":{"0":"pb-1"}}',
                'parameters'    => '{"html_tag":"hr"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'content-003',
                'parent_uid'    => '0',
                'block_uid'    => 'block-009',
                'template_uid'    => 'template-001',
                'type'    => 'content',
                'content'    => 'Application Suite developed to support your Business. [1]',
                'attributes'    => '{"class":{"0":"lead font-weight-normal"}}',
                'parameters'    => '{"html_tag":"h1"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'content-004',
                'parent_uid'    => '0',
                'block_uid'    => 'block-015',
                'template_uid'    => 'template-001',
                'type'    => 'content',
                'content'    => 'Restaurant Management System',
                'attributes'    => '{"class":{"0":"mb-0 display-4 font-weight-normal"}}',
                'parameters'    => '{"html_tag":"h1"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'content-005',
                'parent_uid'    => '0',
                'block_uid'    => 'block-015',
                'template_uid'    => 'template-001',
                'type'    => 'content',
                'content'    => '',
                'attributes'    => '{"class":{"0":"pb-1"}}',
                'parameters'    => '{"html_tag":"hr"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'content-006',
                'parent_uid'    => '0',
                'block_uid'    => 'block-015',
                'template_uid'    => 'template-001',
                'type'    => 'content',
                'content'    => 'Application Suite developed to support your Business. [2]',
                'attributes'    => '{"class":{"0":"lead font-weight-normal"}}',
                'parameters'    => '{"html_tag":"h1"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'content-100',
                'parent_uid'    => '0',
                'block_uid'    => 'block-100',
                'template_uid'    => 'template-002',
                'type'    => 'content',
                'content'    => 'Hello World!',
                'attributes'    => '{"class":{"0":"lead font-weight-normal"}}',
                'parameters'    => '{"html_tag":"h1"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('content');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
