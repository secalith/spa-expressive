<?php


use Phinx\Seed\AbstractSeed;

class PetitionDataAbstractSeeder extends AbstractSeed
{

    public function run()
    {
        $text = <<<HERE
Ogólnym efektem wprowadzenia w życie obu wyżej wymienionych artykułów będzie ograniczenie obywatelom Unii Europejskiej dostępu do informacji oraz możliwości dzielenia się nią. 
Uważamy, że prawo do wolności wypowiedzi oraz otrzymywania i przekazywania informacji bez ingerencji władz publicznych, zawarte w Karcie Praw Podstawowych Unii Europejskiej, jest ważniejsze niż zaostrzenie przepisów dotyczących praw autorskich (wraz z wprowadzeniem prewencji). Wobec powyższych zagrożeń sprzeciwiamy się takim posunięciom hamującym rozwój społeczeństwa informacyjnego w UE.
W całej Europie pilnie śledzimy działania eurodeputowanych podczas pracy w komisjach i na forum Parlamentu Europejskiego, oczekując uwzględnienia głosu tych, których reprezentujecie.

HERE;

        $data = [
            [
                'uid'    => 'petition-text-001',
                'petition_uid'    => 'petition-001',
                'abstract'    => $text,
                'language'    => 'pl_pl',
                'status'    => 1,
                'revision'    => 1,
                'version'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_data_abstract');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
