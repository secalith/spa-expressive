<?php


use Phinx\Seed\AbstractSeed;

class ArticlePostSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'article-post-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'article_uid' => 'article-002',
                'title' => 'Post #1',
                'title_global' => 'Post 001',
                'abstract' => 'abstract (post)',
                'lead' => 'lead (post)',
                'text' => 'text (post)',
                'comm' => '',
                'language' => 'pl_pl',
                'file' => '',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('article_post');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
