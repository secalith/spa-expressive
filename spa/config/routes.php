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
        'Common\Handler\Create',
    ], 'manager.register');
    $app->post('/register[/]', [
        'Common\Handler\Create',
    ], 'manager.register.post');



    ## MANAGER-SPA-SITE

    $app->get('/admin/site/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.site.list');
    $app->get('/admin/site/create[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        Permission\Handler\AuthorizationHandler::class,
        'Common\Handler\List',
    ], 'admin.site.create');
    $app->get('/admin/site/details[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.site.read');



    # MANAGER-SPA-PETITION #

    $app->get('/admin/petition/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'spa.spa-petition.create');
    $app->post('/admin/petition/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'spa.spa-petition.create.post');

    $app->get('/admin/petition/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'spa.spa-petition.list');



    ## SPA-PETITION-SIGNATURE

    $app->post('/popieram[/]', [
        SpaPetition\Handler\SignatureHandler::class,
    ], 'spa.petition.support.post');



    ## MANAGER-EVENT

    $app->get('/admin/event/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.event.list');
    $app->get('/admin/event/details[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.event.read');
    $app->get('/admin/event/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.event.create');
    $app->post('/admin/event/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.event.create.post');



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
