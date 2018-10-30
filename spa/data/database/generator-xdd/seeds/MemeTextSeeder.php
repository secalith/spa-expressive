<?php


use Phinx\Seed\AbstractSeed;

class MemeTextSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'item-001',
                'item_uid' => 'item-001',
                'text' => 'Jutro caly dzien bedzie piatek',
                'comm' => null,
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('meme_text');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
