<?php


use Phinx\Seed\AbstractSeed;

class RecipientsGroupSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'recipient-group-001',
                'name' => 'Polish MEPs',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'recipient-group-002',
                'name' => 'German MEPs',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'recipient-group-003',
                'name' => 'French MEPs',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'recipient-group-004',
                'name' => 'Czech MEPs',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('recipients_group');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
