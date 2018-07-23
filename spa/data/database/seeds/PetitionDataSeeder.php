<?php


use Phinx\Seed\AbstractSeed;

class PetitionDataSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'petition-data-001',
                'petition_uid'    => 'petition-001',
                'text_uid'    => 'petition-text-001',
                'language'    => 'pl_pl',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_data');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
