<?php


use Phinx\Seed\AbstractSeed;

class InstanceSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'instance-0012',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-001',
                'client_uid'    => 'secalith-limited-client',
                'hostname'    => 'spa',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'instance-002',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-002',
                'client_uid'    => 'secalith-limited-client',
                'hostname'    => 'art13',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'instance-003',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-003',
                'client_uid'    => 'secalith-limited-client',
                'hostname'    => 'petitions',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'instance-004',
                'application_uid'    => 'app-002',
                'site_uid'    => 'site-004',
                'client_uid'    => 'secalith-limited-client',
                'hostname'    => 'blog_art13',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'instance-005',
                'application_uid'    => 'app-002',
                'site_uid'    => 'site-005',
                'client_uid'    => 'secalith-limited-client',
                'hostname'    => 'blog_kowalski',
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
