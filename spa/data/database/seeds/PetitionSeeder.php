<?php


use Phinx\Seed\AbstractSeed;

class PetitionSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'petition-001',
                'application_uid'    => 'app-001',
                'site_uid'    => 'site-003',
                'Name'    => 'Petycja Lipiec 2018 #1',
                'data_uid'    => 'petition-data-001',
                'default_language'    => 'pl_pl',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
