<?php


use Phinx\Seed\AbstractSeed;

class BlockSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'block-100',
                'parent_uid'    => '0',
                'area_uid'    => 'area-001',
                'template_uid'    => 'template-001',
                'type'    => 'block',
                'name'    => 'block_100',
                'content'    => '',
                'attributes'    => '{"class":{"0":"row"}}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-5 m-0"}}}}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'block-101',
                'parent_uid'    => '0',
                'area_uid'    => 'area-001',
                'template_uid'    => 'template-001',
                'type'    => 'block',
                'name'    => 'block_101',
                'content'    => null,
                'attributes'    => '{}',
                'parameters'    => '{}',
                'options'    => '{"wrapper":{"outer":{"parameters":{"html_tag":"ul"},"attributes":{"class":"row px-1 px-sm-5 m-0 list-group"}}}}',
                'status'    => 1,
                'order'    => 2,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'block-700',
                'parent_uid'    => '0',
                'area_uid'    => 'area-001',
                'template_uid'    => 'template-001',
                'type'    => 'block',
                'name'    => 'block_700',
                'content'    => null,
                'attributes'    => '{"id":"events-text-join"}',
                'parameters'    => '{}',
                'options'    => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-5 m-0"}}}}',
                'status'    => 1,
                'order'    => 11,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'block-720',
                'parent_uid'    => '0',
                'area_uid'    => 'area-001',
                'template_uid'    => 'template-001',
                'type'    => 'block-event',
                'name'    => 'block_720',
                'content'    => null,
                'attributes'    => '{"id":"block-event-list"}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-5 m-0"}}}}',
                'status'    => 1,
                'order'    => 20,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('block');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
