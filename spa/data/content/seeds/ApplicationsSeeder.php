<?php


use Phinx\Seed\AbstractSeed;

class ApplicationsSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'app-001',
                'type'    => 'spa',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'app-002',
                'type'    => 'spa',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'app-003',
                'type'    => 'spa',
                'comm'    => 'shrt.local.vm',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('application');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
