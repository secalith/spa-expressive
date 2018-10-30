<?php


use Phinx\Seed\AbstractSeed;

class MemeItemSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'item-001',
                'comm' => null,
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('meme_item');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
