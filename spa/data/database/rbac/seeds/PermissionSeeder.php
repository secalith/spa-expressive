<?php


use Phinx\Seed\AbstractSeed;

class PermissionSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'permission-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'user.manage',
                'description' => 'Manage users',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'permission-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'permission.manage',
                'description' => 'Manage permissions',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'permission-003',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'role.manage',
                'description' => 'Manage roles',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'permission-004',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'profile.any.view',
                'description' => 'View anyone\'s profile',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'permission-005',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'profile.own.view',
                'description' => 'View own profile',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'permission-006',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'event.manage',
                'description' => 'Manage event',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'permission-007',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'petition.manage',
                'description' => 'Manage petition',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'permission-008',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'article.manage',
                'description' => 'Manage article',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('permission');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
