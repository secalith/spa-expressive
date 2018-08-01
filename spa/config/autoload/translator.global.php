<?php
//config/autoload/translator.global.php
return [
    'dependencies' => (new \Zend\I18n\ConfigProvider())->getDependencyConfig(),

    'translator' => [
        'locale' => 'en_en',
        'translation_file_patterns' => [
            [
                'type' => 'phparray',
                'base_dir' => 'data/language',
                'pattern' => '%s/spa-art13.php'
            ],
            [
                'type' => 'phparray',
                'base_dir' => 'data/language',
                'pattern' => '%s/spa-art13-register.php'
            ],
            [
                'type' => 'phparray',
                'base_dir' => 'data/language',
                'pattern' => '%s/spa-art13-login.php'
            ],
            [
                'type' => 'phparray',
                'base_dir' => 'data/language',
                'pattern' => '%s/spa-art13-admin.php'
            ],
            [
                'type' => 'phparray',
                'base_dir' => 'data/language',
                'pattern' => '%s/spa-art13-admin-events.php'
            ],
        ],
    ],
];