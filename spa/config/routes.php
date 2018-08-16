<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {

    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    $app->any('/login', Auth\Handler\LoginHandler::class, 'spa.auth.login');
    $app->any('/logout', Auth\Handler\LogoutHandler::class, 'spa.auth.logout');
//    $app->any('/request-reset', Auth\Handler\RequestHandler::class, 'spa.auth.request');
//    $app->any('/password-reset', Auth\Handler\ResetCodeHandler::class, 'spa.auth.reset');
    $app->get('/auth', [Auth\Handler\AuthHandler::class, Auth\Handler\FooHandler::class], 'spa.auth');
    $app->get('/import/page', [Auth\Handler\AuthHandler::class, Import\Handler\ImportPage::class], 'spa.import.page');

    ## SPA-REGISTER
    $app->get('/register[/]', [
        I18n\Handler\I18n::class,
        'Common\Handler\Create',
    ], 'manager.register');
    $app->post('/register[/]', [
        I18n\Handler\I18n::class,
        'Common\Handler\Create',
    ], 'manager.register.post');



    ## SPA-PETITION-SIGNATURE

    $app->post('/popieram[/]', [
        SpaPetition\Handler\SignatureHandler::class,
    ], 'spa.petition.support.post');



    ## MANAGER-SPA-SITE

    $app->get('/admin/site/list[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.site.list');
    $app->get('/admin/site/create[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        Permission\Handler\AuthorizationHandler::class,
        'Common\Handler\List',
    ], 'admin.site.create');
    $app->get('/admin/site/details[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.site.read');



    # MANAGER-PETITION #

    $app->get('/admin/petition/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.petition.create');
    $app->post('/admin/petition/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.petition.create.post');

    $app->get('/admin/petition/details/{uid}[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Read',
    ], 'manager.petition.read');

    $app->get('/admin/petition/edit/{uid}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Update',
    ], 'manager.petition.update');
    $app->post('/admin/petition/edit/{uid}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Update',
    ], 'manager.petition.update.post');

    $app->get('/admin/petition/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.petition.list');

    # MANAGER-PETITION-TRANSLATION #
    $app->get('/admin/petition/translation/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.petition.translation.create');
    $app->post('/admin/petition/translation/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.petition.translation.create.post');



    ## MANAGER-ARTICLE

    $app->get('/admin/article/list[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.article.list');
    $app->get('/admin/article/details[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.article.read');
    $app->get('/admin/article/create[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.article.create');
    $app->post('/admin/article/create[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.article.create.post');

    ## MANAGER-ARTICLE-GROUP

    $app->get('/admin/article-group/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.article-group.list');
    $app->get('/admin/article-group/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.article-group.create');
    $app->post('/admin/article-group/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.article-group.create.post');

    $app->get('/admin/article-group/details[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.article-group.read');


    ## MANAGER-EVENT


    $app->get('/admin/event/create[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.event.create');
    $app->post('/admin/event/create[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.event.create.post');
    $app->get('/admin/event/details/{uid}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Read',
    ], 'manager.event.read');
    $app->get('/admin/event/edit/{uid}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Update',
    ], 'manager.event.update');
    $app->post('/admin/event/edit/{uid}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Update',
    ], 'manager.event.update.post');
    $app->get('/admin/event/list[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.event.list');

    ## MANAGER-EVENT-GROUP

    $app->get('/admin/event-group/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.event-group.list');
    $app->get('/admin/event-group/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.event-group.create');
    $app->post('/admin/event-group/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.event-group.create.post');

    $app->get('/admin/event-group/details[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.event-group.read');



    ## MANAGER-USER

    # USER #
    $app->get('/admin/user/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'spa.user.list');
    # CREATE USER #
    $app->get('/admin/user/create[/]',
        [
            Auth\Handler\AuthHandler::class,
            'Common\Handler\Create',
        ]
        , 'spa.user.create');
    $app->post('/admin/user/create[/]',
        [
            Auth\Handler\AuthHandler::class,
            'Common\Handler\Create',
        ]
        , 'spa.user.create.post');
    # READ USER #
    $app->get('/admin/user/details/{uid}[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Read',
    ], 'spa.user.read');
    # UPDATE USER #
    $app->get('/admin/user/edit/{uid}[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Update',
    ], 'spa.user.update');
    # DELETE USER #
    $app->get('/admin/user/delete/{uid}[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Delete',
    ], 'spa.user.delete');



    ## MANAGER-PAGE

    $app->get('/admin/page/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.page.list');
    # CREATE PAGE #
    $app->get('/admin/page/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'admin.page.create');
    $app->post('/admin/page/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'admin.page.create.post');
    # READ PAGE #
    $app->get('/admin/page/details/{uid}', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.page.read');
};
