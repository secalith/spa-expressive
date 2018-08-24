<?php


use Phinx\Seed\AbstractSeed;

class PageResourceSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'page-resource-001',
                'page_uid' => 'page-003',
                'site_uid' => 'site-003',
                'resource_uid' => 'petition-001',
                'resource_name' => 'petition',
                'resource_type' => 'petition',
                'resource_cache' => 0,
                'parameters' => '{}',
                'comm' => 'petition for peticio.art13.eu',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'page-resource-002',
                'page_uid' => 'page-003',
                'site_uid' => 'site-003',
                'resource_uid' => 'petition-001',
                'resource_name' => '\Petition\Form\PetitionSignatureWriteForm::class',
                'resource_type' => 'form',
                'resource_cache' => 0,
                'parameters' => '{"save":[{"service":{"service_name":"\\\\Petition\\\\Service\\\\EmailQueueService","method_name":"saveGroupQueue"}},{"service":{"service_name":"Petition\\\\Signature\\\\TableService","method_name":"saveItem"}}]}',
                'comm' => 'form for peticio.art13.eu',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'page-resource-003',
                'page_uid' => 'page-004',
                'site_uid' => 'site-004',
                'resource_uid' => 'petition-001',
                'resource_name' => 'petition',
                'resource_type' => 'petition',
                'resource_cache' => 0,
                'parameters' => '{}',
                'comm' => 'petition for peticio.local.vm ',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'page-resource-004',
                'page_uid' => 'page-004',
                'site_uid' => 'site-004',
                'resource_uid' => 'petition-001',
                'resource_name' => '\Petition\Form\PetitionSignatureWriteForm::class',
                'resource_type' => 'form',
                'resource_cache' => 0,
                'parameters' => '{"save":[{"service":{"service_name":"\\\\Petition\\\\Service\\\\EmailQueueService","method_name":"saveGroupQueue"}},{"service":{"service_name":"Petition\\\\Signature\\\\TableService","method_name":"saveItem"}}]}',
                'comm' => 'form for peticio.local.vm',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'page-resource-005',
                'page_uid' => 'page-008',
                'site_uid' => 'site-004',
                'resource_uid' => 'petition-001',
                'resource_name' => 'petition',
                'resource_type' => 'petition',
                'resource_cache' => 0,
                'parameters' => '{}',
                'comm' => 'petition for peticio.local.vm',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'page-resource-006',
                'page_uid' => 'page-008',
                'site_uid' => 'site-004',
                'resource_uid' => 'petition-001',
                'resource_name' => '\Petition\Form\PetitionSignatureWriteForm::class',
                'resource_type' => 'form',
                'resource_cache' => 0,
                'parameters' => '{"save":[{"service":{"service_name":"\\\\Petition\\\\Service\\\\EmailQueueService","method_name":"saveGroupQueue"}},{"service":{"service_name":"Petition\\\\Signature\\\\TableService","method_name":"saveItem"}}]}',
                'comm' => 'form for peticio.local.vm',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],

// ART13
            [
                'uid' => 'page-resource-007',
                'page_uid' => 'page-009',
                'site_uid' => 'site-003',
                'resource_uid' => 'petition-001',
                'resource_name' => 'petition',
                'resource_type' => 'petition',
                'resource_cache' => 0,
                'parameters' => '{}',
                'comm' => 'petition for peticio.art13.eu',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'page-resource-008',
                'page_uid' => 'page-009',
                'site_uid' => 'site-003',
                'resource_uid' => 'petition-001',
                'resource_name' => '\Petition\Form\PetitionSignatureWriteForm::class',
                'resource_type' => 'form',
                'resource_cache' => 0,
                'parameters' => '{"save":[{"service":{"service_name":"\\\\Petition\\\\Service\\\\EmailQueueService","method_name":"saveGroupQueue"}},{"service":{"service_name":"Petition\\\\Signature\\\\TableService","method_name":"saveItem"}}]}',
                'comm' => 'form for peticio.art13.eu',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],

            // petycja.art13.eu
            [
                'uid' => 'page-resource-009',
                'page_uid' => 'page-010',
                'site_uid' => 'site-006',
                'resource_uid' => 'petition-001',
                'resource_name' => 'petition',
                'resource_type' => 'petition',
                'resource_cache' => 0,
                'parameters' => '{}',
                'comm' => 'petition for petycja.art13.eu',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'page-resource-010',
                'page_uid' => 'page-011',
                'site_uid' => 'site-006',
                'resource_uid' => 'petition-001',
                'resource_name' => '\Petition\Form\PetitionSignatureWriteForm::class',
                'resource_type' => 'form',
                'resource_cache' => 0,
                'parameters' => '{"save":[{"service":{"service_name":"\\\\Petition\\\\Service\\\\EmailQueueService","method_name":"saveGroupQueue"}},{"service":{"service_name":"Petition\\\\Signature\\\\TableService","method_name":"saveItem"}}]}',
                'comm' => 'form for petycja.art13.eu',
                'status' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('page_resource');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
