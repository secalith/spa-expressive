<?php


use Phinx\Seed\AbstractSeed;

class PetitionDatePeriodSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'petition-text-001',
                'petition_uid'    => 'petition-001',
                'date_start'    => null,
                'date_end'    => '2018-09-26',
                'change_to'    => 2,
                'status'    => 1,
                'priority'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_date');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
