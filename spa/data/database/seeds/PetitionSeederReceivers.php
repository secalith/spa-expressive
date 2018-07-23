<?php


use Phinx\Seed\AbstractSeed;

class PetitionSeederReceivers extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'petition-001',
                'application_uid'    => 'app-001',
                'receiver_uid'    => 'petition-receiver-001',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_receivers');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
