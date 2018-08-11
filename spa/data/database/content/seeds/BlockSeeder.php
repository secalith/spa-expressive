<?php


use Phinx\Seed\AbstractSeed;

class BlockSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'block-100',
                'parent_uid' => '0',
                'area_uid' => 'area-001',
                'template_uid' => 'template-001',
                'type' => 'block',
                'name' => 'block_100',
                'content' => '',
                'attributes' => '{"class":{"0":"row"}}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-5 m-0"}}}}',
                'comm' => 'art13 homepage; content-header',
                'status' => 1,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-101',
                'parent_uid' => '0',
                'area_uid' => 'area-001',
                'template_uid' => 'template-001',
                'type' => 'block',
                'name' => 'block_101',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"ul"},"attributes":{"class":"row px-1 px-sm-5 m-0 list-group"}}}}',
                'comm' => 'art13 homepage; content-articles-list',
                'status' => 1,
                'order' => 2,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-110',
                'parent_uid' => '0',
                'area_uid' => 'area-001',
                'template_uid' => 'template-001',
                'type' => 'block',
                'name' => 'block_110',
                'content' => null,
                'attributes' => '{"id":"events-text-join"}',
                'parameters' => '{}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-5 m-0"}}}}',
                'comm' => 'art13 homepage; content h2 text [join us]',
                'status' => 1,
                'order' => 11,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-120',
                'parent_uid' => '0',
                'area_uid' => 'area-001',
                'template_uid' => 'template-001',
                'type' => 'block-event',
                'name' => 'block_120',
                'content' => null,
                'attributes' => '{"id":"block-event-list","class":"w-100"}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-5 m-0"}}}}',
                'comm' => 'art13 homepage; events list',
                'status' => 1,
                'order' => 20,
                'created' => date('Y-m-d H:i:s'),
            ],

            [
                'uid' => 'block-200',
                'parent_uid' => '0',
                'area_uid' => 'area-004',
                'template_uid' => 'template-004',
                'type' => 'block-petition-title',
                'name' => 'block_200',
                'content' => null,
                'attributes' => '{"class":{"0":"d-flex justify-content-between w-100"}}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => 'peticio ; petition title',
                'status' => 1,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-201',
                'parent_uid' => '0',
                'area_uid' => 'area-004',
                'template_uid' => 'template-004',
                'type' => 'block-petition-text-full',
                'name' => 'block_201',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => 'peticio ; petition text',
                'status' => 1,
                'order' => 2,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-202',
                'parent_uid' => '0',
                'area_uid' => 'area-004',
                'template_uid' => 'template-004',
                'type' => 'block-petition-signature-form',
                'name' => 'block_202',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => 'peticio ; petitions signature form',
                'status' => 1,
                'order' => 3,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-250',
                'parent_uid' => '0',
                'area_uid' => 'area-005',
                'template_uid' => 'template-005',
                'type' => 'block',
                'name' => 'block_250',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => '',
                'status' => 1,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-600',
                'parent_uid' => '0',
                'area_uid' => 'area-006',
                'template_uid' => 'template-006',
                'type' => 'block',
                'name' => 'block_600',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => 'art13.eu',
                'status' => 1,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-200-a',
                'parent_uid' => '0',
                'area_uid' => 'area-007',
                'template_uid' => 'template-003',
                'type' => 'block-petition-title',
                'name' => 'block_200',
                'content' => null,
                'attributes' => '{"class":{"0":"d-flex justify-content-between w-100"}}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => 'peticio.art13.eu',
                'status' => 1,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-201-a',
                'parent_uid' => '0',
                'area_uid' => 'area-007',
                'template_uid' => 'template-003',
                'type' => 'block-petition-text-full',
                'name' => 'block_201',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => '',
                'status' => 1,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-300',
                'parent_uid' => '0',
                'area_uid' => 'area-008',
                'template_uid' => 'template-007',
                'type' => 'block',
                'name' => 'block_300',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => '',
                'status' => 1,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-301',
                'parent_uid' => '0',
                'area_uid' => 'area-008',
                'template_uid' => 'template-007',
                'type' => 'block',
                'name' => 'block_301',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"ul"},"attributes":{"class":"row px-1 px-sm-4 m-0 list-group"}}}}',
                'comm' => '',
                'status' => 1,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-200-post',
                'parent_uid' => '0',
                'area_uid' => 'area-009',
                'template_uid' => 'template-008',
                'type' => 'block-petition-title',
                'name' => 'block_200',
                'content' => null,
                'attributes' => '{"class":{"0":"d-flex justify-content-between w-100"}}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => 'peticio ; petition title',
                'status' => 1,
                'order' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-201-post',
                'parent_uid' => '0',
                'area_uid' => 'area-009',
                'template_uid' => 'template-008',
                'type' => 'block-petition-text-full',
                'name' => 'block_201',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => 'peticio ; petition text',
                'status' => 1,
                'order' => 2,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'block-202-post',
                'parent_uid' => '0',
                'area_uid' => 'area-009',
                'template_uid' => 'template-008',
                'type' => 'block-petition-signature-form',
                'name' => 'block_202',
                'content' => null,
                'attributes' => '{}',
                'parameters' => '{"html_tag":"div"}',
                'options' => '{"wrapper":{"outer":{"parameters":{"html_tag":"div"},"attributes":{"class":"row px-1 px-sm-4 m-0"}}}}',
                'comm' => 'peticio ; petitions signature form',
                'status' => 1,
                'order' => 3,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('block');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
