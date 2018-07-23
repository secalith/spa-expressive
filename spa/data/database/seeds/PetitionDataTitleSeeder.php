<?php


use Phinx\Seed\AbstractSeed;

class PetitionDataTitleSeeder extends AbstractSeed
{

    public function run()
    {
        $data = [
            [
                'uid'    => 'petition-text-001',
                'petition_uid'    => 'petition-001',
                'title'    => "Petycja Lipiec 2018",
                'language'    => 'pl_pl',
                'status'    => 1,
                'revision'    => 1,
                'version'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_data_title');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
