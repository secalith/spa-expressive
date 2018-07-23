<?php


use Phinx\Seed\AbstractSeed;

class PetitionSeederReceiversData extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'petition-001',
                'receiver_uid'    => 'petition-receiver-001',
                'name'    => 'Ministerstwo Zdrowia',
                'email'    => 'Jan F Kowalski',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_receivers_data');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
