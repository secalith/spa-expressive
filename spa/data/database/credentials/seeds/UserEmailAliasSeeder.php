<?php


use Phinx\Seed\AbstractSeed;

class UserEmailAliasSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'admin-demo',
                'email'    => 'jan@kowalski.name',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('user_email_alias');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
