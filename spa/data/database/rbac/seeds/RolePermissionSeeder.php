<?php


use Phinx\Seed\AbstractSeed;

class RolePermissionSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'role-permission-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'role_uid' => 'role-001',
                'permission_uid' => 'permission-001',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'role-permission-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'role_uid' => 'role-001',
                'permission_uid' => 'permission-002',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'role-permission-003',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'role_uid' => 'role-001',
                'permission_uid' => 'permission-003',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'role-permission-004',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'role_uid' => 'role-001',
                'permission_uid' => 'permission-004',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'role-permission-005',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'role_uid' => 'role-001',
                'permission_uid' => 'permission-005',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'role-permission-006',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'role_uid' => 'role-001',
                'permission_uid' => 'permission-006',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'role-permission-007',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'role_uid' => 'role-001',
                'permission_uid' => 'permission-007',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'role-permission-008',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'role_uid' => 'role-001',
                'permission_uid' => 'permission-008',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'role-permission-009',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'role_uid' => 'role-001',
                'permission_uid' => 'permission-005',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('role_permission');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
