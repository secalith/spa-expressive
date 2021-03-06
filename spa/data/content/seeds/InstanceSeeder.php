<?php


use Phinx\Seed\AbstractSeed;

class InstanceSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'instance-001',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-001',
                'client_uid'    => 'secalith-limited-client',
                'hostname'    => 'manager.local.vm',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'instance-002',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-002',
                'client_uid'    => 'ponad-podzialami-client',
                'hostname'    => 'art13.eu',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'instance-003',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-003',
                'client_uid'    => 'ponad-podzialami-client',
                'hostname'    => 'peticio.art13.eu',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'instance-004',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-004',
                'client_uid'    => 'ponad-podzialami-peticio-client',
                'hostname'    => 'peticio.local.vm',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'instance-005',
                'application_uid'    => 'app-003',
                'site_uid'    => 'site-005',
                'client_uid'    => 'shrt.ovh',
                'hostname'    => 'shrt.local.vm',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'instance-006',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-006',
                'client_uid'    => 'ponad-podzialami-client',
                'hostname'    => 'petycja.art13.eu',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('instances');

        $table->truncate();

        $table->insert($data)
            ->save();
    }
}
