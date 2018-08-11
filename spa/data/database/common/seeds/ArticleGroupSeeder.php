<?php


use Phinx\Seed\AbstractSeed;

class ArticleGroupSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'article-group-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'name' => 'Article Group #1',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('article_group');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
