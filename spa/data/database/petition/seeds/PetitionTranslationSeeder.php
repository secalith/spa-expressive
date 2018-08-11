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
                'uid' => 'petition-translation-004',
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
        ];

        $table = $this->table('petition_translation');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
