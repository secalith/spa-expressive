<?php


use Phinx\Seed\AbstractSeed;

class PetitionSignatureSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'petition-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-004',
                'petition_uid' => 'petition-001',
                'name' => 'Jan',
                'email' => 'jan@secalith.co.uk',
                'ip' => '127',
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_signature');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
