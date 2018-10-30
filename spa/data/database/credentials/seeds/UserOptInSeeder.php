<?php


use Phinx\Seed\AbstractSeed;

class UserOptInSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'admin-demo',
                'terms'    => '1',
                'newsletter'    => '1',
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('user_optin');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
