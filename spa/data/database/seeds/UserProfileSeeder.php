<?php


use Phinx\Seed\AbstractSeed;

class UserProfileSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'admin-demo',
                'name_first'    => 'Jan',
                'name_last'    => 'Kowalski',
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('user_profile');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
