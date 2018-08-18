<?php


use Phinx\Seed\AbstractSeed;

class PetitionTranslationSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'uid' => 'petition-translation-001',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'petition_uid' => 'petition-001',
                'title' => 'Petycja po polsku',
                'description' => 'Ogólnym efektem wprowadzenia w życie obu wyżej wymienionych artykułów będzie ograniczenie obywatelom Unii Europejskiej dostępu do informacji oraz możliwości dzielenia się nią. 
Uważamy, że prawo do wolności wypowiedzi oraz otrzymywania i przekazywania informacji bez ingerencji władz publicznych, zawarte w Karcie Praw Podstawowych Unii Europejskiej, jest ważniejsze niż zaostrzenie przepisów dotyczących praw autorskich (wraz z wprowadzeniem prewencji). Wobec powyższych zagrożeń sprzeciwiamy się takim posunięciom hamującym rozwój społeczeństwa informacyjnego w UE.
W całej Europie pilnie śledzimy działania eurodeputowanych podczas pracy w komisjach i na forum Parlamentu Europejskiego, oczekując uwzględnienia głosu tych, których reprezentujecie.',
                'text' => '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet arcu a leo bibendum tincidunt nec sed diam. Morbi suscipit ante in ante egestas, feugiat bibendum mauris tempus. Suspendisse sed lobortis justo, nec scelerisque mauris. Etiam vitae ante ex. Integer varius rhoncus purus, in tincidunt urna. Suspendisse sed ligula ut leo elementum auctor quis in turpis. Nunc sodales arcu eget dui faucibus, id elementum metus laoreet. Sed vehicula neque eget ante venenatis dignissim. Sed pulvinar eget metus sed porttitor. Sed sed enim ac ipsum aliquam finibus.

Duis tempor quis sapien et finibus. Curabitur vestibulum neque risus, eget interdum felis tincidunt vitae. Nulla eget ex urna. Nullam vel lacinia elit. Suspendisse hendrerit leo sed massa vehicula, a vulputate eros fringilla. Pellentesque fringilla vitae massa ornare vestibulum. Proin turpis nibh, convallis at orci vitae, vulputate rutrum augue. Fusce magna lacus, ornare faucibus tellus in, porta vestibulum ligula. Fusce finibus nisi id diam tincidunt, eu vehicula orci eleifend. Proin vel odio eu nisl tempor vulputate ut at eros.

Nulla sed sollicitudin sem, ac scelerisque erat. Quisque posuere turpis ex. Praesent laoreet magna finibus, maximus tellus feugiat, pharetra massa. Morbi sed quam dignissim, sollicitudin elit nec, tempor purus. Nulla tristique libero in ante dignissim, ut ultricies ligula molestie. Donec vel tristique urna, ut commodo nunc. Donec congue justo et elementum rhoncus. Praesent tincidunt commodo ligula vel dictum. Mauris maximus, augue at sollicitudin vehicula, urna enim sollicitudin tortor, in egestas arcu massa eu lorem.

Fusce commodo nulla quis aliquam posuere. Mauris ipsum ipsum, aliquam ac auctor ut, tincidunt sed ex. Vivamus non est pellentesque, lacinia dui eu, auctor arcu. Fusce rhoncus nibh in molestie rutrum. Vestibulum non laoreet dui. Nulla tempus turpis sed velit vulputate, quis laoreet libero volutpat. Donec vel hendrerit metus, malesuada vestibulum elit.

Proin egestas tristique sapien sit amet suscipit. Vivamus massa nisl, porttitor vitae mattis sit amet, bibendum sit amet odio. Praesent laoreet tristique cursus. Ut vitae fringilla turpis. Praesent laoreet fringilla venenatis. Proin sed placerat ligula, et pulvinar tortor. Pellentesque semper ipsum mauris, non eleifend ipsum tincidunt eu. Maecenas viverra erat vitae dui viverra accumsan. Curabitur vehicula ex eu feugiat ultrices. In dapibus tincidunt purus, quis efficitur odio sodales vel. Morbi ac lectus at eros auctor laoreet ac non elit. ',
                'image' => '',
                'comm' => '',
                'language' => 'pl_pl',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'petition-translation-002',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'petition_uid' => 'petition-001',
                'title' => 'Petycja po angielsku',
                'description' => 'Petycja po angielsku',
                'text' => '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet arcu a leo bibendum tincidunt nec sed diam. Morbi suscipit ante in ante egestas, feugiat bibendum mauris tempus. Suspendisse sed lobortis justo, nec scelerisque mauris. Etiam vitae ante ex. Integer varius rhoncus purus, in tincidunt urna. Suspendisse sed ligula ut leo elementum auctor quis in turpis. Nunc sodales arcu eget dui faucibus, id elementum metus laoreet. Sed vehicula neque eget ante venenatis dignissim. Sed pulvinar eget metus sed porttitor. Sed sed enim ac ipsum aliquam finibus.

Duis tempor quis sapien et finibus. Curabitur vestibulum neque risus, eget interdum felis tincidunt vitae. Nulla eget ex urna. Nullam vel lacinia elit. Suspendisse hendrerit leo sed massa vehicula, a vulputate eros fringilla. Pellentesque fringilla vitae massa ornare vestibulum. Proin turpis nibh, convallis at orci vitae, vulputate rutrum augue. Fusce magna lacus, ornare faucibus tellus in, porta vestibulum ligula. Fusce finibus nisi id diam tincidunt, eu vehicula orci eleifend. Proin vel odio eu nisl tempor vulputate ut at eros.

Nulla sed sollicitudin sem, ac scelerisque erat. Quisque posuere turpis ex. Praesent laoreet magna finibus, maximus tellus feugiat, pharetra massa. Morbi sed quam dignissim, sollicitudin elit nec, tempor purus. Nulla tristique libero in ante dignissim, ut ultricies ligula molestie. Donec vel tristique urna, ut commodo nunc. Donec congue justo et elementum rhoncus. Praesent tincidunt commodo ligula vel dictum. Mauris maximus, augue at sollicitudin vehicula, urna enim sollicitudin tortor, in egestas arcu massa eu lorem.

Fusce commodo nulla quis aliquam posuere. Mauris ipsum ipsum, aliquam ac auctor ut, tincidunt sed ex. Vivamus non est pellentesque, lacinia dui eu, auctor arcu. Fusce rhoncus nibh in molestie rutrum. Vestibulum non laoreet dui. Nulla tempus turpis sed velit vulputate, quis laoreet libero volutpat. Donec vel hendrerit metus, malesuada vestibulum elit.

Proin egestas tristique sapien sit amet suscipit. Vivamus massa nisl, porttitor vitae mattis sit amet, bibendum sit amet odio. Praesent laoreet tristique cursus. Ut vitae fringilla turpis. Praesent laoreet fringilla venenatis. Proin sed placerat ligula, et pulvinar tortor. Pellentesque semper ipsum mauris, non eleifend ipsum tincidunt eu. Maecenas viverra erat vitae dui viverra accumsan. Curabitur vehicula ex eu feugiat ultrices. In dapibus tincidunt purus, quis efficitur odio sodales vel. Morbi ac lectus at eros auctor laoreet ac non elit. ',
                'image' => '',
                'comm' => '',
                'language' => 'en_en',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'petition-translation-003',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'petition_uid' => 'petition-001',
                'title' => 'Petycja po niemiecku',
                'description' => 'Petycja po niemiecku',
                'text' => '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet arcu a leo bibendum tincidunt nec sed diam. Morbi suscipit ante in ante egestas, feugiat bibendum mauris tempus. Suspendisse sed lobortis justo, nec scelerisque mauris. Etiam vitae ante ex. Integer varius rhoncus purus, in tincidunt urna. Suspendisse sed ligula ut leo elementum auctor quis in turpis. Nunc sodales arcu eget dui faucibus, id elementum metus laoreet. Sed vehicula neque eget ante venenatis dignissim. Sed pulvinar eget metus sed porttitor. Sed sed enim ac ipsum aliquam finibus.

Duis tempor quis sapien et finibus. Curabitur vestibulum neque risus, eget interdum felis tincidunt vitae. Nulla eget ex urna. Nullam vel lacinia elit. Suspendisse hendrerit leo sed massa vehicula, a vulputate eros fringilla. Pellentesque fringilla vitae massa ornare vestibulum. Proin turpis nibh, convallis at orci vitae, vulputate rutrum augue. Fusce magna lacus, ornare faucibus tellus in, porta vestibulum ligula. Fusce finibus nisi id diam tincidunt, eu vehicula orci eleifend. Proin vel odio eu nisl tempor vulputate ut at eros.

Nulla sed sollicitudin sem, ac scelerisque erat. Quisque posuere turpis ex. Praesent laoreet magna finibus, maximus tellus feugiat, pharetra massa. Morbi sed quam dignissim, sollicitudin elit nec, tempor purus. Nulla tristique libero in ante dignissim, ut ultricies ligula molestie. Donec vel tristique urna, ut commodo nunc. Donec congue justo et elementum rhoncus. Praesent tincidunt commodo ligula vel dictum. Mauris maximus, augue at sollicitudin vehicula, urna enim sollicitudin tortor, in egestas arcu massa eu lorem.

Fusce commodo nulla quis aliquam posuere. Mauris ipsum ipsum, aliquam ac auctor ut, tincidunt sed ex. Vivamus non est pellentesque, lacinia dui eu, auctor arcu. Fusce rhoncus nibh in molestie rutrum. Vestibulum non laoreet dui. Nulla tempus turpis sed velit vulputate, quis laoreet libero volutpat. Donec vel hendrerit metus, malesuada vestibulum elit.

Proin egestas tristique sapien sit amet suscipit. Vivamus massa nisl, porttitor vitae mattis sit amet, bibendum sit amet odio. Praesent laoreet tristique cursus. Ut vitae fringilla turpis. Praesent laoreet fringilla venenatis. Proin sed placerat ligula, et pulvinar tortor. Pellentesque semper ipsum mauris, non eleifend ipsum tincidunt eu. Maecenas viverra erat vitae dui viverra accumsan. Curabitur vehicula ex eu feugiat ultrices. In dapibus tincidunt purus, quis efficitur odio sodales vel. Morbi ac lectus at eros auctor laoreet ac non elit. ',
                'image' => '',
                'comm' => '',
                'language' => 'de_de',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'petition-translation-004',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'petition_uid' => 'petition-001',
                'title' => 'Petycja po czesku',
                'description' => 'Petycja po czesku',
                'text' => '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet arcu a leo bibendum tincidunt nec sed diam. Morbi suscipit ante in ante egestas, feugiat bibendum mauris tempus. Suspendisse sed lobortis justo, nec scelerisque mauris. Etiam vitae ante ex. Integer varius rhoncus purus, in tincidunt urna. Suspendisse sed ligula ut leo elementum auctor quis in turpis. Nunc sodales arcu eget dui faucibus, id elementum metus laoreet. Sed vehicula neque eget ante venenatis dignissim. Sed pulvinar eget metus sed porttitor. Sed sed enim ac ipsum aliquam finibus.

Duis tempor quis sapien et finibus. Curabitur vestibulum neque risus, eget interdum felis tincidunt vitae. Nulla eget ex urna. Nullam vel lacinia elit. Suspendisse hendrerit leo sed massa vehicula, a vulputate eros fringilla. Pellentesque fringilla vitae massa ornare vestibulum. Proin turpis nibh, convallis at orci vitae, vulputate rutrum augue. Fusce magna lacus, ornare faucibus tellus in, porta vestibulum ligula. Fusce finibus nisi id diam tincidunt, eu vehicula orci eleifend. Proin vel odio eu nisl tempor vulputate ut at eros.

Nulla sed sollicitudin sem, ac scelerisque erat. Quisque posuere turpis ex. Praesent laoreet magna finibus, maximus tellus feugiat, pharetra massa. Morbi sed quam dignissim, sollicitudin elit nec, tempor purus. Nulla tristique libero in ante dignissim, ut ultricies ligula molestie. Donec vel tristique urna, ut commodo nunc. Donec congue justo et elementum rhoncus. Praesent tincidunt commodo ligula vel dictum. Mauris maximus, augue at sollicitudin vehicula, urna enim sollicitudin tortor, in egestas arcu massa eu lorem.

Fusce commodo nulla quis aliquam posuere. Mauris ipsum ipsum, aliquam ac auctor ut, tincidunt sed ex. Vivamus non est pellentesque, lacinia dui eu, auctor arcu. Fusce rhoncus nibh in molestie rutrum. Vestibulum non laoreet dui. Nulla tempus turpis sed velit vulputate, quis laoreet libero volutpat. Donec vel hendrerit metus, malesuada vestibulum elit.

Proin egestas tristique sapien sit amet suscipit. Vivamus massa nisl, porttitor vitae mattis sit amet, bibendum sit amet odio. Praesent laoreet tristique cursus. Ut vitae fringilla turpis. Praesent laoreet fringilla venenatis. Proin sed placerat ligula, et pulvinar tortor. Pellentesque semper ipsum mauris, non eleifend ipsum tincidunt eu. Maecenas viverra erat vitae dui viverra accumsan. Curabitur vehicula ex eu feugiat ultrices. In dapibus tincidunt purus, quis efficitur odio sodales vel. Morbi ac lectus at eros auctor laoreet ac non elit. ',
                'image' => '',
                'comm' => '',
                'language' => 'cz_cz',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'petition-translation-005',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'petition_uid' => 'petition-001',
                'title' => 'Petycja po francusku',
                'description' => 'Petycja po francusku',
                'text' => '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet arcu a leo bibendum tincidunt nec sed diam. Morbi suscipit ante in ante egestas, feugiat bibendum mauris tempus. Suspendisse sed lobortis justo, nec scelerisque mauris. Etiam vitae ante ex. Integer varius rhoncus purus, in tincidunt urna. Suspendisse sed ligula ut leo elementum auctor quis in turpis. Nunc sodales arcu eget dui faucibus, id elementum metus laoreet. Sed vehicula neque eget ante venenatis dignissim. Sed pulvinar eget metus sed porttitor. Sed sed enim ac ipsum aliquam finibus.

Duis tempor quis sapien et finibus. Curabitur vestibulum neque risus, eget interdum felis tincidunt vitae. Nulla eget ex urna. Nullam vel lacinia elit. Suspendisse hendrerit leo sed massa vehicula, a vulputate eros fringilla. Pellentesque fringilla vitae massa ornare vestibulum. Proin turpis nibh, convallis at orci vitae, vulputate rutrum augue. Fusce magna lacus, ornare faucibus tellus in, porta vestibulum ligula. Fusce finibus nisi id diam tincidunt, eu vehicula orci eleifend. Proin vel odio eu nisl tempor vulputate ut at eros.

Nulla sed sollicitudin sem, ac scelerisque erat. Quisque posuere turpis ex. Praesent laoreet magna finibus, maximus tellus feugiat, pharetra massa. Morbi sed quam dignissim, sollicitudin elit nec, tempor purus. Nulla tristique libero in ante dignissim, ut ultricies ligula molestie. Donec vel tristique urna, ut commodo nunc. Donec congue justo et elementum rhoncus. Praesent tincidunt commodo ligula vel dictum. Mauris maximus, augue at sollicitudin vehicula, urna enim sollicitudin tortor, in egestas arcu massa eu lorem.

Fusce commodo nulla quis aliquam posuere. Mauris ipsum ipsum, aliquam ac auctor ut, tincidunt sed ex. Vivamus non est pellentesque, lacinia dui eu, auctor arcu. Fusce rhoncus nibh in molestie rutrum. Vestibulum non laoreet dui. Nulla tempus turpis sed velit vulputate, quis laoreet libero volutpat. Donec vel hendrerit metus, malesuada vestibulum elit.

Proin egestas tristique sapien sit amet suscipit. Vivamus massa nisl, porttitor vitae mattis sit amet, bibendum sit amet odio. Praesent laoreet tristique cursus. Ut vitae fringilla turpis. Praesent laoreet fringilla venenatis. Proin sed placerat ligula, et pulvinar tortor. Pellentesque semper ipsum mauris, non eleifend ipsum tincidunt eu. Maecenas viverra erat vitae dui viverra accumsan. Curabitur vehicula ex eu feugiat ultrices. In dapibus tincidunt purus, quis efficitur odio sodales vel. Morbi ac lectus at eros auctor laoreet ac non elit. ',
                'image' => '',
                'comm' => '',
                'language' => 'fr_fr',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],


// ART13
            [
                'uid' => 'petition-translation-006',
                'application_uid' => 'app-001',
                'site_uid' => 'site-001',
                'petition_uid' => 'petition-002',
                'title' => 'Petycja po polsku',
                'description' => '
',
                'text' => '

Szanowna Pani Poseł / Szanowny Panie Pośle


wzywamy do odrzucenia projektu dyrektywy Parlamentu Europejskiego i Rady o prawach autorskich na jednolitym rynku cyfrowym (on Digital Single Market), a przynajmniej usunięcia artykułów 11. i 13., które pod pretekstem ochrony praw autorskich godzą w wolność wypowiedzi  na łamach Internetu.


Jako użytkownicy Internetu jesteśmy w najwyższym stopniu zaniepokojeni wizją jego cenzurowania. Poniżej zamieszczamy opis zagrożeń, jakie niesie ze sobą wprowadzenie tych zapisów.


*Art. 13* przewiduje, że właściciele serwisów społecznościowych będą musieli uzyskiwać od właścicieli praw autorskich licencje na treści zamieszczane przez ich użytkowników oraz wdrożyć "odpowiednie środki" w celu zapobiegania dostępności w tych serwisach treści nielicencjonowanych.
W praktyce oznaczać to będzie, że serwisy takie będą musiały wdrożyć kosztowne automatyczne filtry do sprawdzania wszystkich  treści zamieszczanych przez użytkownika. Co za tym idzie:

* Dostępne dla użytkowników w Unii Europejskiej pozostaną jedynie te serwisy, które będzie stać na wdrożenie owych "odpowiednich środków", w praktyce mogą to być jedynie największe portale, takie jak Facebook, Twitter czy Youtube;
* Ponieważ sprawdzanie takie technicznie jest skomplikowane, a automatyczne filtry nie są doskonałe, blokowane i usuwane będą też treści nienaruszające praw autorskich (np. przeróbki parodystyczne dozwolone w wielu państwach UE);
* Z uwagi na powyższe korzystanie z portali społecznościowych może stanie się utrudnione i nieatrakcyjne;
* Artykuł właściwie wprowadza cenzurę prewencyjną - to twórca serwisu musi wystrzegać się  nieodpowiednich treści pod groźbą konsekwencji prawnych;
* Pojawi się groźba wykorzystania tych filtrów do przymusowego cenzurowania treści z powodów innych niż prawo autorskie (np. politycznych czy światopoglądowych) - nie będzie już alternatywy w postaci niezależnych serwisów niestosujących takich filtrów.


*Art.* 11 przewiduje, że publikowanie nawet krótkich fragmentów tekstów prasowych - takich jak "zajawki" przy linkach lub tytuły - zostanie objęte wymogiem uzyskania zgody od dostawcy publikacji prasowej, w praktyce zwykle za opłatą. Może to doprowadzić do:

* Ograniczenia dostępności na terenie Unii Europejskiej do agregatorów linków, takich jak np. Google News (po wprowadzeniu podobnego prawa w Hiszpanii Google wycofał tę usługę dla użytkowników z tego kraju);
*  Upadku mniejszych serwisów agregujących linki, których nie będzie stać na opłaty;
* Likwidacji "zajawek" przy linkach na takich portalach jak Facebook i w konsekwencji zmniejszenia ich atrakcyjności;
* Upadku mniejszych portali informacyjnych, które zdobywają czytelników dzięki odnośnikom w portalach społecznościowych i agregatorach linków.


Ogólnym efektem wprowadzenia w życie obu wyżej wymienionych artykułów będzie ograniczenie obywatelom Unii Europejskiej dostępu do informacji oraz możliwości dzielenia się nią. 
Uważamy, że prawo do wolności wypowiedzi oraz otrzymywania i przekazywania informacji bez ingerencji władz publicznych, zawarte w Karcie Praw Podstawowych Unii Europejskiej, jest ważniejsze niż zaostrzenie przepisów dotyczących praw autorskich (wraz z wprowadzeniem prewencji). Wobec powyższych zagrożeń sprzeciwiamy się takim posunięciom hamującym rozwój społeczeństwa informacyjnego w UE.


W całej Europie pilnie śledzimy działania eurodeputowanych podczas pracy w komisjach i na forum Parlamentu Europejskiego, oczekując uwzględnienia głosu tych, których reprezentujecie.',
                'image' => '',
                'comm' => '',
                'language' => 'pl_pl',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'petition-translation-007',
                'application_uid' => 'app-001',
                'site_uid' => 'site-002',
                'petition_uid' => 'petition-002',
                'title' => 'Petycja po angielsku',
                'description' => 'Petycja po angielsku',
                'text' => '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet arcu a leo bibendum tincidunt nec sed diam. Morbi suscipit ante in ante egestas, feugiat bibendum mauris tempus. Suspendisse sed lobortis justo, nec scelerisque mauris. Etiam vitae ante ex. Integer varius rhoncus purus, in tincidunt urna. Suspendisse sed ligula ut leo elementum auctor quis in turpis. Nunc sodales arcu eget dui faucibus, id elementum metus laoreet. Sed vehicula neque eget ante venenatis dignissim. Sed pulvinar eget metus sed porttitor. Sed sed enim ac ipsum aliquam finibus.

Duis tempor quis sapien et finibus. Curabitur vestibulum neque risus, eget interdum felis tincidunt vitae. Nulla eget ex urna. Nullam vel lacinia elit. Suspendisse hendrerit leo sed massa vehicula, a vulputate eros fringilla. Pellentesque fringilla vitae massa ornare vestibulum. Proin turpis nibh, convallis at orci vitae, vulputate rutrum augue. Fusce magna lacus, ornare faucibus tellus in, porta vestibulum ligula. Fusce finibus nisi id diam tincidunt, eu vehicula orci eleifend. Proin vel odio eu nisl tempor vulputate ut at eros.

Nulla sed sollicitudin sem, ac scelerisque erat. Quisque posuere turpis ex. Praesent laoreet magna finibus, maximus tellus feugiat, pharetra massa. Morbi sed quam dignissim, sollicitudin elit nec, tempor purus. Nulla tristique libero in ante dignissim, ut ultricies ligula molestie. Donec vel tristique urna, ut commodo nunc. Donec congue justo et elementum rhoncus. Praesent tincidunt commodo ligula vel dictum. Mauris maximus, augue at sollicitudin vehicula, urna enim sollicitudin tortor, in egestas arcu massa eu lorem.

Fusce commodo nulla quis aliquam posuere. Mauris ipsum ipsum, aliquam ac auctor ut, tincidunt sed ex. Vivamus non est pellentesque, lacinia dui eu, auctor arcu. Fusce rhoncus nibh in molestie rutrum. Vestibulum non laoreet dui. Nulla tempus turpis sed velit vulputate, quis laoreet libero volutpat. Donec vel hendrerit metus, malesuada vestibulum elit.

Proin egestas tristique sapien sit amet suscipit. Vivamus massa nisl, porttitor vitae mattis sit amet, bibendum sit amet odio. Praesent laoreet tristique cursus. Ut vitae fringilla turpis. Praesent laoreet fringilla venenatis. Proin sed placerat ligula, et pulvinar tortor. Pellentesque semper ipsum mauris, non eleifend ipsum tincidunt eu. Maecenas viverra erat vitae dui viverra accumsan. Curabitur vehicula ex eu feugiat ultrices. In dapibus tincidunt purus, quis efficitur odio sodales vel. Morbi ac lectus at eros auctor laoreet ac non elit. ',
                'image' => '',
                'comm' => '',
                'language' => 'en_en',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'petition-translation-008',
                'application_uid' => 'app-001',
                'site_uid' => 'site-002',
                'petition_uid' => 'petition-002',
                'title' => 'Petycja po niemiecku',
                'description' => 'Petycja po niemiecku',
                'text' => '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet arcu a leo bibendum tincidunt nec sed diam. Morbi suscipit ante in ante egestas, feugiat bibendum mauris tempus. Suspendisse sed lobortis justo, nec scelerisque mauris. Etiam vitae ante ex. Integer varius rhoncus purus, in tincidunt urna. Suspendisse sed ligula ut leo elementum auctor quis in turpis. Nunc sodales arcu eget dui faucibus, id elementum metus laoreet. Sed vehicula neque eget ante venenatis dignissim. Sed pulvinar eget metus sed porttitor. Sed sed enim ac ipsum aliquam finibus.

Duis tempor quis sapien et finibus. Curabitur vestibulum neque risus, eget interdum felis tincidunt vitae. Nulla eget ex urna. Nullam vel lacinia elit. Suspendisse hendrerit leo sed massa vehicula, a vulputate eros fringilla. Pellentesque fringilla vitae massa ornare vestibulum. Proin turpis nibh, convallis at orci vitae, vulputate rutrum augue. Fusce magna lacus, ornare faucibus tellus in, porta vestibulum ligula. Fusce finibus nisi id diam tincidunt, eu vehicula orci eleifend. Proin vel odio eu nisl tempor vulputate ut at eros.

Nulla sed sollicitudin sem, ac scelerisque erat. Quisque posuere turpis ex. Praesent laoreet magna finibus, maximus tellus feugiat, pharetra massa. Morbi sed quam dignissim, sollicitudin elit nec, tempor purus. Nulla tristique libero in ante dignissim, ut ultricies ligula molestie. Donec vel tristique urna, ut commodo nunc. Donec congue justo et elementum rhoncus. Praesent tincidunt commodo ligula vel dictum. Mauris maximus, augue at sollicitudin vehicula, urna enim sollicitudin tortor, in egestas arcu massa eu lorem.

Fusce commodo nulla quis aliquam posuere. Mauris ipsum ipsum, aliquam ac auctor ut, tincidunt sed ex. Vivamus non est pellentesque, lacinia dui eu, auctor arcu. Fusce rhoncus nibh in molestie rutrum. Vestibulum non laoreet dui. Nulla tempus turpis sed velit vulputate, quis laoreet libero volutpat. Donec vel hendrerit metus, malesuada vestibulum elit.

Proin egestas tristique sapien sit amet suscipit. Vivamus massa nisl, porttitor vitae mattis sit amet, bibendum sit amet odio. Praesent laoreet tristique cursus. Ut vitae fringilla turpis. Praesent laoreet fringilla venenatis. Proin sed placerat ligula, et pulvinar tortor. Pellentesque semper ipsum mauris, non eleifend ipsum tincidunt eu. Maecenas viverra erat vitae dui viverra accumsan. Curabitur vehicula ex eu feugiat ultrices. In dapibus tincidunt purus, quis efficitur odio sodales vel. Morbi ac lectus at eros auctor laoreet ac non elit. ',
                'image' => '',
                'comm' => '',
                'language' => 'de_de',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'petition-translation-009',
                'application_uid' => 'app-001',
                'site_uid' => 'site-002',
                'petition_uid' => 'petition-002',
                'title' => 'Petycja po czesku',
                'description' => 'Petycja po czesku',
                'text' => '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet arcu a leo bibendum tincidunt nec sed diam. Morbi suscipit ante in ante egestas, feugiat bibendum mauris tempus. Suspendisse sed lobortis justo, nec scelerisque mauris. Etiam vitae ante ex. Integer varius rhoncus purus, in tincidunt urna. Suspendisse sed ligula ut leo elementum auctor quis in turpis. Nunc sodales arcu eget dui faucibus, id elementum metus laoreet. Sed vehicula neque eget ante venenatis dignissim. Sed pulvinar eget metus sed porttitor. Sed sed enim ac ipsum aliquam finibus.

Duis tempor quis sapien et finibus. Curabitur vestibulum neque risus, eget interdum felis tincidunt vitae. Nulla eget ex urna. Nullam vel lacinia elit. Suspendisse hendrerit leo sed massa vehicula, a vulputate eros fringilla. Pellentesque fringilla vitae massa ornare vestibulum. Proin turpis nibh, convallis at orci vitae, vulputate rutrum augue. Fusce magna lacus, ornare faucibus tellus in, porta vestibulum ligula. Fusce finibus nisi id diam tincidunt, eu vehicula orci eleifend. Proin vel odio eu nisl tempor vulputate ut at eros.

Nulla sed sollicitudin sem, ac scelerisque erat. Quisque posuere turpis ex. Praesent laoreet magna finibus, maximus tellus feugiat, pharetra massa. Morbi sed quam dignissim, sollicitudin elit nec, tempor purus. Nulla tristique libero in ante dignissim, ut ultricies ligula molestie. Donec vel tristique urna, ut commodo nunc. Donec congue justo et elementum rhoncus. Praesent tincidunt commodo ligula vel dictum. Mauris maximus, augue at sollicitudin vehicula, urna enim sollicitudin tortor, in egestas arcu massa eu lorem.

Fusce commodo nulla quis aliquam posuere. Mauris ipsum ipsum, aliquam ac auctor ut, tincidunt sed ex. Vivamus non est pellentesque, lacinia dui eu, auctor arcu. Fusce rhoncus nibh in molestie rutrum. Vestibulum non laoreet dui. Nulla tempus turpis sed velit vulputate, quis laoreet libero volutpat. Donec vel hendrerit metus, malesuada vestibulum elit.

Proin egestas tristique sapien sit amet suscipit. Vivamus massa nisl, porttitor vitae mattis sit amet, bibendum sit amet odio. Praesent laoreet tristique cursus. Ut vitae fringilla turpis. Praesent laoreet fringilla venenatis. Proin sed placerat ligula, et pulvinar tortor. Pellentesque semper ipsum mauris, non eleifend ipsum tincidunt eu. Maecenas viverra erat vitae dui viverra accumsan. Curabitur vehicula ex eu feugiat ultrices. In dapibus tincidunt purus, quis efficitur odio sodales vel. Morbi ac lectus at eros auctor laoreet ac non elit. ',
                'image' => '',
                'comm' => '',
                'language' => 'cz_cz',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'uid' => 'petition-translation-010',
                'application_uid' => 'app-001',
                'site_uid' => 'site-002',
                'petition_uid' => 'petition-002',
                'title' => 'Petycja po francusku',
                'description' => 'Petycja po francusku',
                'text' => '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet arcu a leo bibendum tincidunt nec sed diam. Morbi suscipit ante in ante egestas, feugiat bibendum mauris tempus. Suspendisse sed lobortis justo, nec scelerisque mauris. Etiam vitae ante ex. Integer varius rhoncus purus, in tincidunt urna. Suspendisse sed ligula ut leo elementum auctor quis in turpis. Nunc sodales arcu eget dui faucibus, id elementum metus laoreet. Sed vehicula neque eget ante venenatis dignissim. Sed pulvinar eget metus sed porttitor. Sed sed enim ac ipsum aliquam finibus.

Duis tempor quis sapien et finibus. Curabitur vestibulum neque risus, eget interdum felis tincidunt vitae. Nulla eget ex urna. Nullam vel lacinia elit. Suspendisse hendrerit leo sed massa vehicula, a vulputate eros fringilla. Pellentesque fringilla vitae massa ornare vestibulum. Proin turpis nibh, convallis at orci vitae, vulputate rutrum augue. Fusce magna lacus, ornare faucibus tellus in, porta vestibulum ligula. Fusce finibus nisi id diam tincidunt, eu vehicula orci eleifend. Proin vel odio eu nisl tempor vulputate ut at eros.

Nulla sed sollicitudin sem, ac scelerisque erat. Quisque posuere turpis ex. Praesent laoreet magna finibus, maximus tellus feugiat, pharetra massa. Morbi sed quam dignissim, sollicitudin elit nec, tempor purus. Nulla tristique libero in ante dignissim, ut ultricies ligula molestie. Donec vel tristique urna, ut commodo nunc. Donec congue justo et elementum rhoncus. Praesent tincidunt commodo ligula vel dictum. Mauris maximus, augue at sollicitudin vehicula, urna enim sollicitudin tortor, in egestas arcu massa eu lorem.

Fusce commodo nulla quis aliquam posuere. Mauris ipsum ipsum, aliquam ac auctor ut, tincidunt sed ex. Vivamus non est pellentesque, lacinia dui eu, auctor arcu. Fusce rhoncus nibh in molestie rutrum. Vestibulum non laoreet dui. Nulla tempus turpis sed velit vulputate, quis laoreet libero volutpat. Donec vel hendrerit metus, malesuada vestibulum elit.

Proin egestas tristique sapien sit amet suscipit. Vivamus massa nisl, porttitor vitae mattis sit amet, bibendum sit amet odio. Praesent laoreet tristique cursus. Ut vitae fringilla turpis. Praesent laoreet fringilla venenatis. Proin sed placerat ligula, et pulvinar tortor. Pellentesque semper ipsum mauris, non eleifend ipsum tincidunt eu. Maecenas viverra erat vitae dui viverra accumsan. Curabitur vehicula ex eu feugiat ultrices. In dapibus tincidunt purus, quis efficitur odio sodales vel. Morbi ac lectus at eros auctor laoreet ac non elit. ',
                'image' => '',
                'comm' => '',
                'language' => 'fr_fr',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_translation');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
