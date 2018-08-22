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

    ## SPA-AUTH-REGISTER
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



    ## ADMIN-SPA-APPLICATION

    $app->get('/admin/application/list[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.application.list');
    $app->get('/admin/application/create[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        Permission\Handler\AuthorizationHandler::class,
        'Common\Handler\List',
    ], 'admin.application.create');
    $app->get('/admin/application/details[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.application.read');
    $app->get('/admin/application/edit/{uid}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Update',
    ], 'admin.application.update');


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


    ## MANAGER-SPA-ROUTER

    $app->get('/admin/router/list[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.router.list');
    $app->get('/admin/router/create[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        Permission\Handler\AuthorizationHandler::class,
        'Common\Handler\List',
    ], 'admin.router.create');
    $app->get('/admin/router/details[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.router.read');
    $app->get('/admin/router/edit[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.router.update');



    ## MANAGER-SPA-TEMPLATE

    $app->get('/admin/page-template/list[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.page-template.list');
    $app->get('/admin/page-template/create[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        Permission\Handler\AuthorizationHandler::class,
        'Common\Handler\List',
    ], 'admin.page-template.create');
    $app->get('/admin/page-template/details[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.page-template.read');
    $app->get('/admin/page-template/edit[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.page-template.update');



    ## MANAGER-SPA-INSTANCE

    $app->get('/admin/instance/list[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.instance.list');
    $app->get('/admin/instance/create[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        Permission\Handler\AuthorizationHandler::class,
        'Common\Handler\List',
    ], 'admin.instance.create');
    $app->get('/admin/instance/details[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.instance.read');
    $app->get('/admin/instance/edit[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.instance.update');




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



    ## MANAGER-PAGE

    $app->get('/admin/page-resource/list[/[{page:\d+}]]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.page-resource.list');
    # CREATE PAGE #
    $app->get('/admin/page-resource/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'admin.page-resource.create');
    $app->post('/admin/page-resource/create[/]', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'admin.page-resource.create.post');
    # READ PAGE #
    $app->get('/admin/page-resource/details/{uid}', [
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'admin.page-resource.read');



    ## MANAGER-CONTENT

    $app->get('/admin/content/create[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.content.create');
    $app->post('/admin/content/create[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Create',
    ], 'manager.event.content.post');
    $app->get('/admin/content/details/{uid}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Read',
    ], 'manager.content.read');
    $app->get('/admin/content/edit/{uid}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Update',
    ], 'manager.content.update');
    $app->post('/admin/content/edit/{uid}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Update',
    ], 'manager.content.update.post');
    $app->get('/admin/content/list[/[{page:\d+}]]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\List',
    ], 'manager.content.list');

    ## API-CONTENT
    $app->get('/api/content/details/{uid}/{format}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Api\ApiRead',
    ], 'api.content.read');
    $app->get('/admin/content/edit/{uid}/{method}[/]', [
        I18n\Handler\I18n::class,
        Auth\Handler\AuthHandler::class,
        'Common\Handler\Api\ApiUpdate',
    ], 'api.content.update.post');

};
