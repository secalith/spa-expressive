<?php


use Phinx\Seed\AbstractSeed;

class ContentSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'content-001',
                'parent_uid'    => null,
                'block_uid'    => 'block-001',
                'template_uid'    => 'template-001',
                'type'    => 'content',
                'content'    => 'Hello World!',
                'attributes'    => '{"class":{"0":"display-1"}}',
                'parameters'    => '{"html_tag":"div"}',
                'options'    => '{}',
                'status'    => '1',
                'order'    => '1',
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('content');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
