<?php


use Phinx\Seed\AbstractSeed;

class ArticleSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'article-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'article_type' => 'external',
                'article_group' => 'article-group-001',
                'name' => 'Olaboga',
                'country' => 'pl_pl',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'article-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'article_type' => 'post',
                'article_group' => 'article-group-001',
                'name' => 'Olaboga #2',
                'country' => 'pl_pl',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('article');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
