<?php

declare(strict_types=1);

namespace Common;

use Common\Controller\Delegator\Delegator;
use Common\Helper\CurrentRouteNameHelper;
use Common\Helper\CurrentHandlerNameHelper;
use Common\Helper\Factory\CurrentRouteNameHelperFactory;
use Common\Helper\Factory\CurrentHandlerNameHelperFactory;
use Common\View\Helper\Factory\DisplayLinkGroupHelperFactory;
use Common\Middleware\CurrentRouteNameMiddleware;
use Common\Middleware\CurrentHandlerNameMiddleware;
use Common\Middleware\CurrentUrlMiddleware;
use Common\Middleware\Factory\CurrentRouteNameMiddlewareFactory;
use Common\Middleware\Factory\CurrentHandlerNameMiddlewareFactory;
use Common\Middleware\Factory\CurrentUrlMiddlewareFactory;
use Common\Middleware\Factory\HandlerCacheMiddlewareFactory;
use Common\Middleware\Factory\StaticPageHandlerCacheMiddlewareFactory;
use Common\Middleware\HandlerCacheMiddleware;
//use Common\Middleware\PostRedirectGet;
use Common\Middleware\StaticPageHandlerCacheMiddleware;
use Common\View\Helper\CurrentUrlHelper;
use Common\View\Helper\Factory\CurrentUrlHelperFactory;
use Common\View\Helper\Factory\MarkdownViewHelperFactory;
use Common\View\Helper\FlashMessage;
use Common\View\Helper\GetFormAttached;
use Common\View\Helper\IsFormSet;
use Michelf\Markdown;
use Whoops\Handler\Handler;
use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;

class ConfigProvider
{

    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'view_helpers'  => [
                'invokables' => [
                    'isFormSet' => IsFormSet::class,
                    'getFormAttached' => GetFormAttached::class,
                    'flashMessage' => FlashMessage::class,
                    'closeTag' => View\Helper\CloseTagHelper::class,
                    'translate' => \Zend\I18n\View\Helper\Translate::class

                ],
                'factories' => [
                    'currentRoute' => CurrentUrlHelperFactory::class,
                    'displayLinkGroup' => DisplayLinkGroupHelperFactory::class,
                    'openTag' => View\Helper\OpenTagHelperFactory::class,
                    'markdown' => \Common\View\Helper\Factory\MarkdownViewHelperFactory::class,
                ],
            ],
            'session_config' => [
                'cookie_lifetime' => 60*60*100,
                'gc_maxlifetime' => 60*60*24*300,
            ],
            'session_manager' => [
                'validators' => [
                    RemoteAddr::class,
                    HttpUserAgent::class,
                ]
            ],
            'session_storage' => [
                'type' => SessionArrayStorage::class
            ],
            'cache' => [
                'enabled' => true,
                'path' => 'data/cache/',
                'lifetime' => 3600
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                CurrentUrlHelper::class => CurrentUrlHelper::class,
                Markdown::class => Markdown::class,

            ],
            'factories' => [
//                \Common\Handler\ResourceHandler::class => \Common\Handler\Factory\ResourceHandlerFactory::class,
                \Common\Service\MarkdownService::class => \Common\Service\Factory\MarkdownServiceFactory::class,
                CurrentUrlMiddleware::class => CurrentUrlMiddlewareFactory::class,

                CurrentHandlerNameMiddleware::class => CurrentHandlerNameMiddlewareFactory::class,
                CurrentHandlerNameHelper::class => CurrentHandlerNameHelperFactory::class,

                CurrentRouteNameMiddleware::class => CurrentRouteNameMiddlewareFactory::class,
                CurrentRouteNameHelper::class => CurrentRouteNameHelperFactory::class,

                StaticPageHandlerCacheMiddleware::class => StaticPageHandlerCacheMiddlewareFactory::class,
                \Common\Service\RouteConfigService::class => \Common\Service\Factory\RouteConfigServiceFactory::class,
                \Common\Service\PaginatorQueryService::class => \Common\Service\Factory\PaginatorQueryServiceFactory::class,

                Service\RouteResourceService::class => Service\Factory\RouteResourceServiceFactory::class,
            ],
            'abstract_factories' => [
                Service\GatewayAbstractFactory::class,
                Service\TableServiceAbstractFactory::class,
                \Common\Handler\Factory\CreateHandlerAbstractFactory::class,
                \Common\Handler\Factory\ReadHandlerAbstractFactory::class,
                \Common\Handler\Api\Factory\ApiReadHandlerAbstractFactory::class,
                \Common\Handler\Factory\UpdateHandlerAbstractFactory::class,
                \Common\Handler\Factory\DeleteHandlerAbstractFactory::class,
                \Common\Handler\Factory\ListHandlerAbstractFactory::class,
            ],
            'delegators' => [
                \Zend\Expressive\Application::class => [
                    \Common\Application\Factory\PipelineAndRoutesDelegator::class,
                ],
                'Common\Handler\Create' => [
                    \Common\Handler\Delegator\ApplicationConfigAwareDelegator::class,
                    \Common\Delegator\RouteResourceAwareDelegator::class,
                    \Common\Delegator\ApplicationFormRouteAwareDelegator::class,
                    \Common\Handler\Delegator\ApplicationFieldsetSaveServiceAwareDelegator::class,
                ],
                'Common\Handler\Read' => [
                    \Common\Handler\Delegator\ApplicationConfigAwareDelegator::class,
                    \Common\Delegator\ApplicationFormRouteAwareDelegator::class,
                    \Common\Handler\Delegator\ApplicationFieldsetSaveServiceAwareDelegator::class,
                ],
                'Common\Handler\Update' => [
                    \Common\Handler\Delegator\ApplicationConfigAwareDelegator::class,
                    \Common\Delegator\ApplicationFormRouteAwareDelegator::class,
                    \Common\Handler\Delegator\ApplicationFieldsetSaveServiceAwareDelegator::class,
                ],
                'Common\Handler\Delete' => [
                    \Common\Handler\Delegator\ApplicationConfigAwareDelegator::class,
                    \Common\Delegator\RouteResourceAwareDelegator::class,
                    \Common\Delegator\ApplicationFormRouteAwareDelegator::class,
                    \Common\Handler\Delegator\ApplicationFieldsetSaveServiceAwareDelegator::class,
                ],
            ],
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
                'common' => [__DIR__ . '/../templates/common'],
                'common-admin' => [__DIR__ . '/../templates/common-admin'],
                'common-admin-partial' => [__DIR__ . '/../templates/common-admin/common-admin-partial'],
                'common-manager' => [__DIR__ . '/../templates/common-manager'],
                'common-manager-partial' => [__DIR__ . '/../templates/common-manager/common-manager-partial'],
            ],
        ];
    }

}
