<?php


use Phinx\Seed\AbstractSeed;

class MemeImageSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'item-001',
                'item_uid' => 'item-001',
                'image' => 'source-1.png',
                'comm' => null,
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('meme_image');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
