<?php


use Phinx\Seed\AbstractSeed;

class ArticleExternalSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid'    => 'external_article-001',
                'type'    => 'external',
                'title'    => 'Wywiad radiowy z naszymi liderami',
                'text_lead'    => 'Usłysz nasz głos.',
                'image'    => 'template-001',
                'publisher_url'    => 'http://www.kontestacja.com/',
                'publisher_name'    => 'kontestacja.com',
                'link_url'    => 'http://www.kontestacja.com/unia-europejska-cenzuruje-internet,5300',
                'status'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('article_external');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
