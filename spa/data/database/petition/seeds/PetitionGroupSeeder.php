<?php


use Phinx\Seed\AbstractSeed;

class PetitionGroupSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'petition-group-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'Group #stopACTA2',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'petition-group-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-002',
                'name' => 'Group #stopACTA2 (production)',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_group');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
