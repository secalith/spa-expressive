<?php


use Phinx\Seed\AbstractSeed;

class ArticleExternalSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'article-external-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'article_uid' => 'article-001',
                'name' => 'Post #1',
                'name_global' => 'Post 001',
                'link' => 'abstract (post)',
                'description' => 'Post 01',
                'publisher' => 'Post 001',
                'publisher_url' => 'Post 001',
                'language' => 'pl_pl',
                'file' => '',
                'comm' => '',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('article_external');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
