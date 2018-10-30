<?php


use Phinx\Seed\AbstractSeed;

class RoleSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'role-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'Administrator',
                'description' => 'A person who manages users, roles, etc.',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'role-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'Guest',
                'description' => 'A person who can log in and view own profile.',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('role');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
