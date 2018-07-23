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
        ];

        $table = $this->table('application');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
