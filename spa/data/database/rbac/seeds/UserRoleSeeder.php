<?php


use Phinx\Seed\AbstractSeed;

class UserRoleSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'role-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'user_uid' => 'admin-demo',
                'role_uid' => 'role-001',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('user_role');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
