<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'admin-demo',
                'email'    => 'jan@secalith.co.uk',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('user');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
