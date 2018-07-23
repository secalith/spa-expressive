<?php


use Phinx\Seed\AbstractSeed;

class PetitionDataTextSeeder extends AbstractSeed
{

    public function run()
    {
        $text = <<<HERE
Szanowna Pani Poseł / Szanowny Panie Pośle

wzywamy do odrzucenia projektu dyrektywy Parlamentu Europejskiego i Rady o prawach autorskich na jednolitym rynku cyfrowym (on Digital Single Market), a przynajmniej usunięcia artykułów 11. i 13., które pod pretekstem ochrony praw autorskich godzą w wolność wypowiedzi  na łamach Internetu.

Jako użytkownicy Internetu jesteśmy w najwyższym stopniu zaniepokojeni wizją jego cenzurowania. Poniżej zamieszczamy opis zagrożeń, jakie niesie ze sobą wprowadzenie tych zapisów.

Art. 13 przewiduje, że właściciele serwisów społecznościowych będą musieli uzyskiwać od właścicieli praw autorskich licencje na treści zamieszczane przez ich użytkowników oraz wdrożyć "odpowiednie środki" w celu zapobiegania dostępności w tych serwisach treści nielicencjonowanych.
W praktyce oznaczać to będzie, że serwisy takie będą musiały wdrożyć kosztowne automatyczne filtry do sprawdzania wszystkich  treści zamieszczanych przez użytkownika. Co za tym idzie:
- Dostępne dla użytkowników w Unii Europejskiej pozostaną jedynie te serwisy, które będzie stać na wdrożenie owych "odpowiednich środków", w praktyce mogą to być jedynie największe portale, takie jak Facebook, Twitter czy Youtube;
- Ponieważ sprawdzanie takie technicznie jest skomplikowane, a automatyczne filtry nie są doskonałe, blokowane i usuwane będą też treści nienaruszające praw autorskich (np. przeróbki parodystyczne dozwolone w wielu państwach UE);
- Z uwagi na powyższe korzystanie z portali społecznościowych może stanie się utrudnione i nieatrakcyjne;
- Artykuł właściwie wprowadza cenzurę prewencyjną - to twórca serwisu musi wystrzegać się  nieodpowiednich treści pod groźbą konsekwencji prawnych;
- Pojawi się groźba wykorzystania tych filtrów do przymusowego cenzurowania treści z powodów innych niż prawo autorskie (np. politycznych czy światopoglądowych) - nie będzie już alternatywy w postaci niezależnych serwisów niestosujących takich filtrów.

Art. 11 przewiduje, że publikowanie nawet krótkich fragmentów tekstów prasowych - takich jak "zajawki" przy linkach lub tytuły - zostanie objęte wymogiem uzyskania zgody od dostawcy publikacji prasowej, w praktyce zwykle za opłatą. Może to doprowadzić do:
- Ograniczenia dostępności na terenie Unii Europejskiej do agregatorów linków, takich jak np. Google News (po wprowadzeniu podobnego prawa w Hiszpanii Google wycofał tę usługę dla użytkowników z tego kraju);
-  Upadku mniejszych serwisów agregujących linki, których nie będzie stać na opłaty;
- Likwidacji "zajawek" przy linkach na takich portalach jak Facebook i w konsekwencji zmniejszenia ich atrakcyjności;
- Upadku mniejszych portali informacyjnych, które zdobywają czytelników dzięki odnośnikom w portalach społecznościowych i agregatorach linków.

Ogólnym efektem wprowadzenia w życie obu wyżej wymienionych artykułów będzie ograniczenie obywatelom Unii Europejskiej dostępu do informacji oraz możliwości dzielenia się nią. 
Uważamy, że prawo do wolności wypowiedzi oraz otrzymywania i przekazywania informacji bez ingerencji władz publicznych, zawarte w Karcie Praw Podstawowych Unii Europejskiej, jest ważniejsze niż zaostrzenie przepisów dotyczących praw autorskich (wraz z wprowadzeniem prewencji). Wobec powyższych zagrożeń sprzeciwiamy się takim posunięciom hamującym rozwój społeczeństwa informacyjnego w UE.
W całej Europie pilnie śledzimy działania eurodeputowanych podczas pracy w komisjach i na forum Parlamentu Europejskiego, oczekując uwzględnienia głosu tych, których reprezentujecie.

HERE;

        $data = [
            [
                'uid'    => 'petition-text-001',
                'petition_uid'    => 'petition-001',
                'text'    => $text,
                'language'    => 'pl_pl',
                'status'    => 1,
                'revision'    => 1,
                'version'    => 1,
                'created'    => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_data_text');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
