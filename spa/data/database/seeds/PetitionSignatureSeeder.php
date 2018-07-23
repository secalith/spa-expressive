<?php


use Phinx\Seed\AbstractSeed;

class PetitionSignatureSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'petition-text-001',
                'petition_uid'    => 'petition-001',
                'petition_text_uid'    => 'petition-text-001',
                'name_first'    => 'Jan Franciszek',
                'name_last'    => 'Kowalski',
                'email'    => 'jan@kowalski.name',
                'language'    => 'pl_pl',
                'ip'    => '127',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

//        $table = $this->table('petition_signature');
//        $table->truncate();
//        $table->insert($data)
//            ->save();
    }
}
