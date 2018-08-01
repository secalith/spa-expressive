<?php


use Phinx\Seed\AbstractSeed;

class CredentialsSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'admin-demo',
                'password'    => '$2y$10$tYS7tevL/JlbOUhUdADRC.ogsKHwdG2zLEYrzWHq9vOel/4p3cnme',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
            [
                'uid'    => 'stopacta-grzegorz',
                'password'    => '$2y$10$tYS7tevL/JlbOUhUdADRC.ogsKHwdG2zLEYrzWHq9vOel/4p3cnme',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('credentials');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
