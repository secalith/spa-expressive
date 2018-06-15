<?php


use Phinx\Seed\AbstractSeed;

class InstanceSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'secalith-limited',
                'application_uid'    => 'secalith-limited-site',
                'client_uid'    => 'secalith-limited-client',
                'hostname'    => 'cv',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('instance');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
