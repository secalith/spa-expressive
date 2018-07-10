<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
//    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    $app->any('/login', Auth\Handler\LoginHandler::class, 'spa.auth.login');
    $app->any('/logout', Auth\Handler\LogoutHandler::class, 'spa.auth.logout');
    $app->any('/request-reset', Auth\Handler\RequestHandler::class, 'spa.auth.request');
    $app->any('/password-reset', Auth\Handler\ResetCodeHandler::class, 'spa.auth.reset');
    $app->get('/auth', [Auth\Handler\AuthHandler::class, Auth\Handler\FooHandler::class], 'spa.auth');
    $app->get('/import/page', [Auth\Handler\AuthHandler::class, Import\Handler\ImportPage::class], 'spa.import.page');

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
        'Common\Handler\List',
    ], 'spa.user.read');
    # DELETE USER #
    $app->get('/admin/user/delete/{uid}[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Delete',
    ], 'spa.user.delete');
//    $app->get('/admin/user/delete/{uid}[/]', [
//        Auth\Handler\AuthHandler::class,
//        'Common\Handler\Delete',
//    ], 'spa.user.delete.post');

    # SITE #
    $app->get('/admin/site/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.site.list');
    $app->get('/admin/site/create[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.site.create');
    $app->get('/admin/site/details[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.site.read');

    # PAGE #
    $app->get('/admin/page/list[/[{page:\d+}]]', [
        'Common\Handler\List',
    ], 'spa.page.list');
    # CREATE PAGE #
    $app->get('/admin/page/create[/]', [
        'Common\Handler\List',
    ], 'spa.page.create');
    $app->post('/admin/page/create[/]', [
        'Common\Handler\List',
    ], 'spa.page.create.post');
    # READ PAGE #
    $app->get('/admin/page/details/{uid}', [
        'Common\Handler\List',
    ], 'spa.page.read');
};
