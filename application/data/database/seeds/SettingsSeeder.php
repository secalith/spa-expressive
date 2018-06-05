<?php


use Phinx\Seed\AbstractSeed;

class SettingsSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'settings-001',
                'module'    => 'filesystem',
                'name'    => 'cache_global',
                'value'    => '0',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('settings');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
