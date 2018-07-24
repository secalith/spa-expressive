<?php


use Phinx\Seed\AbstractSeed;

class SignatureSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'signature-001',
                'petition_uid'    => 'petition-001',
                'name_first'    => 'Jan',
                'name_last'    => ' Kowalski',
                'contact_email'    => 'jan@kowalski.name',
                'ip'    => '127',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('signature');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
