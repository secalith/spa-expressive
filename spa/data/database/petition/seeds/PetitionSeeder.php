<?php


use Phinx\Seed\AbstractSeed;

class PetitionSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'petition-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'group' => 'petition-group-001',
                'name' => 'Petycja Sierpien #1',
                'name_global' => 'Peticion August #1',
                'country' => 'global',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
