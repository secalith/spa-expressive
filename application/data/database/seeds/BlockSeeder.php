<?php


use Phinx\Seed\AbstractSeed;

class BlockSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'block-001',
                'parent_uid'    => null,
                'area_uid'    => 'area-001',
                'template_uid'    => 'template-001',
                'type'    => 'content',
                'name'    => 'Custom Block #1',
                'content'    => '[::content:content-001::]',
                'attributes'    => '{"class":{"0":"row"}}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{}',
                'status'    => 1,
                'order'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],

        ];

        $table = $this->table('block');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
